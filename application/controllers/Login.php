<?php
defined("BASEPATH") or exit("No direct script access allowed");

class Login extends CI_Controller {
  public function __construct() {
    parent::__construct();
    $this->load->model("Baksos_model", "baksos");
  }

  public function index()
  {
    is_not_logged_in();
    // $data = $this->db->get("data_hvn")->row_array();
    if ($this->session->userdata("username")) {
      redirect("admin");
    }

    $this->form_validation->set_rules("username", "username", "required|trim");
    $this->form_validation->set_rules("password", "password", "required|trim");

    if ($this->form_validation->run() == false) {
      $data["title"] = "Admin BakSos";
      $data["menu_"] = "Login page";
      $this->load->view("templates/header_login", $data);
      $this->load->view("login/index", $data);
      $this->load->view("templates/footer_login");
    } else {
      $this->_login();
    }
  }

  private function _login()
  {
    $username = $this->input->post("username");
    $password = $this->input->post("password");

    $panit = $this->baksos->getAdminWhere($username);

    if ($panit) {
      if ($panit["is_active"] == 1) {
        if (password_verify($password, $panit["password"])) {
          $this->session->set_userdata(["username" => $panit["username"]]);
          redirect("admin");
          
        } else {
          $this->session->set_flashdata("message", "<div class='alert alert-danger' role='alert'>Password is incorrect!</div>");
          redirect("login");
        }
      } else {
        $this->session->set_flashdata("message", "<div class='alert alert-danger' role='alert'>This account has not been activated!<br>Please check your email</div>");
        redirect("login");
      }
    } else {
      $this->session->set_flashdata("message", "<div class='alert alert-danger' role='alert'>Username is not registered!</div>");
      redirect("login");
    }
  }

  public function verify() {
    $email = $this->input->get("email");
    $token = $this->input->get("token");

    $panit = $this->db->get_where("panit", ["email" => $email])->row_array();
    if ($panit) {
      $panit_token = $this->db->get_where("panit_token", ["email" => $email, "token" => $token])->row_array();
      if ($panit_token) {
        $this->session->set_userdata("reset_email", $email);
        $this->changePassword();
      } else {
        $this->session->set_flashdata("message", "<div class='alert alert-danger' role='alert'><b>WRONG TOKEN</b> Account activation failed!</div>");
        redirect("login");
      }
    } else {
      $this->session->set_flashdata("message", "<div class='alert alert-danger' role='alert'><b>WRONG EMAIL</b> Account activation failed!</div>");
      redirect("login");
    }
  }

  public function logout() {
    $this->session->unset_userdata("username");
    $this->session->set_flashdata("message", "<div class='alert alert-success' role='alert'>You have been logged out!</div>");
    redirect("login");
  }

  public function forgotPassword() {
    $data = $this->db->get("data_hvn")->row_array();
    $this->form_validation->set_rules("email", "email", "trim|required|valid_email");

    if ($this->form_validation->run() == false) {
      $data["title"] = "Panitia HUVENATION Login";
      $data["menu_"] = "Forgot your password?";
      $this->load->view("templates/login_header", $data);
      $this->load->view("login/forgotpassword", $data);
      $this->load->view("templates/login_footer");
    } else {
      $email = $this->input->post("email");
      $panit = $this->db->get_where("panit", ["email" => $email])->row_array();

      if ($panit) {
        if ($panit["is_activated"] == 1) {
          if ($panit["is_active"] == 1) {
            $token = base64_encode(random_bytes(32));
            $panit_token = [
              "email" => $email,
              "token" => $token,
              "type"  => "change",
              "date_created" => time()
            ];
            $data_token = $this->db->get_where("panit_token", ["email" => $email])->row_array();
            if ($data_token) {
              $this->db->delete("panit_token", ["email" => $email]);
            }
            $this->db->insert("panit_token", $panit_token);

            $this->_sendEmail($token);

            $this->session->set_flashdata("message", "<div class='alert alert-success' role='alert'>Please check your email to reset password!</div>");
            redirect("login/forgotpassword");
          } else {
            $this->session->set_flashdata("message", "<div class='alert alert-danger' role='alert'>This account is not activated by admin!</div>");
            redirect("login/forgotpassword");
          }
        } else {
          $this->session->set_flashdata("message", "<div class='alert alert-danger' role='alert'>Email has not been activated!</div>");
          redirect("login/forgotpassword");
        }
      } else {
        $this->session->set_flashdata("message", "<div class='alert alert-danger' role='alert'>Email is not registered!</div>");
        redirect("login/forgotpassword");
      }
    }
  }

  private function _sendEmail($token)
  {
    $config = [
      "protocol"  => "smtp",
      "smtp_host" => "ssl://smtp.googlemail.com",
      "smtp_user" => "hvn.db1@gmail.com",
      "smtp_pass" => "huvenation.db1",
      "smtp_port" => 465,
      "mailtype"  => "html",
      "charset"   => "utf-8",
      "newline"   => "\r\n"
    ];
    $this->email->initialize($config);

    $email = htmlspecialchars(strtolower($this->input->post("email", true)));
    $data = $this->db->get_where("panit", ["email" => $email])->row_array();
    $this->email->from("hvn.db1@gmail.com", "HUVENATION - Don Bosco 1");
    $this->email->to($email);
    $this->email->subject("Change Password");
    $this->email->message("
    <h2>Reset your password!</h2>
      <p>Please click the link below to reset your password</p>
      <h4><a href='" . base_url("login/resetpassword") . "?email=" . $email . "&token=" . urlencode($token) . "'>Reset My Password</a></h4>
    ");

    if ($this->email->send()) {
      return true;
    } else {
      echo $this->email->print_debugger();
      die;
    }
  }

  public function resetPassword()
  {
    $email = $this->input->get("email");
    $token = $this->input->get("token");

    $panit = $this->db->get_where("panit", ["email" => $email])->row_array();
    if ($panit) {
      $panit_token = $this->db->get_where("panit_token", ["email" => $email, "token" => $token])->row_array();
      if ($panit_token) {
        if (time() - $panit_token["date_created"] < (60 * 60 * 24)) {
          $this->session->set_userdata("reset_email", $email);
          $this->changePassword();
        } else {
          $this->db->delete("panit_token", ["email" => $email]);

          $this->session->set_flashdata("message", "<div class='alert alert-danger' role='alert'><b>TOKEN EXPIRED</b> Reset password failed!</div>");
          redirect("login");
        }
      } else {
        $this->session->set_flashdata("message", "<div class='alert alert-danger' role='alert'><b>WRONG TOKEN</b> Reset password failed!</div>");
        redirect("login");
      }
    } else {
      $this->session->set_flashdata("message", "<div class='alert alert-danger' role='alert'><b>WRONG EMAIL</b> Reset password failed!</div>");
      redirect("login");
    }
  }

  public function changePassword()
  {
    $data = $this->db->get("data_hvn")->row_array();
    $this->session->unset_userdata("username");
    $this->session->unset_userdata("role_id");
    $data["email"] = $this->session->userdata("reset_email");
    $type = $this->db->get_where("panit_token", ["email" => $data["email"]])->row_array();
    if (!$data["email"]) {
      redirect("login");
    }

    $this->form_validation->set_rules("password1", "password", "required|trim|min_length[4]|matches[password2]", [
      "matches" => "Password don't match!",
      "min_length" => "Password too short!"
    ]);
    $this->form_validation->set_rules("password2", "password", "required|trim|min_length[4]|matches[password1]");

    if ($type["type"] == "verify") {
      $menu_ = "Set your password";
    } else {
      $menu_ = "Reset password";
    }

    if ($this->form_validation->run() == false) {
      $data["title"] = "Panitia HUVENATION Login";
      $data["menu_"] = $menu_;
      $this->load->view("templates/login_header", $data);
      $this->load->view("login/resetpassword", $data);
      $this->load->view("templates/login_footer");
    } else {
      $password = password_hash($this->input->post("password1"), PASSWORD_DEFAULT);
      $panit = $this->db->get_where("panit", ["email" => $data["email"]])->row_array();

      if ($type["type"] == "verify") {
        $this->db->set("is_activated", 1);
        $this->db->where("email", $data["email"]);
        $this->db->update("panit");
        $this->db->delete("panit_token", ["email" => $data["email"]]);
        $this->session->unset_userdata("reset_email");

        $this->session->set_flashdata("message", "<div class='alert alert-success' role='alert'><b>" . ucfirst($panit["username"]) . "</b> account activation success! Please login</div>");
        redirect("login");
      } else {
        $this->db->set("password", $password);
        $this->db->where("email", $data["email"]);
        $this->db->update("panit");
        $this->db->delete("panit_token", ["email" => $data["email"]]);
        $this->session->unset_userdata("reset_email");

        $this->session->set_flashdata("message", "<div class='alert alert-success' role='alert'>Password has been changed! Please login</div>");
        redirect("login");
      }
    }
  }

  public function blocked()
  {
    $data = $this->db->get("data_hvn")->row_array();
    $this->load->view("login/blocked", $data);
  }
}
