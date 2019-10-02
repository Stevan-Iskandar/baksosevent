<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    is_logged_in();
    $this->load->model("Baksos_model", "baksos");
  }

  public function index()
  {
    $username = $this->session->userdata("username");
    $data["title"] = "Admin BakSos";
    $data["menu_"] = "Manage data";
    $data["menu"] = $this->baksos->getAllAdminMenu();
    $data["admin"] = $this->baksos->getAdminWhere($username);
    $data["event"] = $this->baksos->getAllevent();

    $this->form_validation->set_rules("nama", "nama", "required|trim");
    $this->form_validation->set_rules("lokasi", "lokasi", "required|trim");
    $this->form_validation->set_rules("tanggal", "tanggal", "required|trim");
    $this->form_validation->set_rules("waktu", "waktu", "required|trim");
    $this->form_validation->set_rules("deskripsi", "deskripsi", "required|trim");
    $this->form_validation->set_rules("data_donasi", "data donasi", "required|trim");

    if ($this->form_validation->run() == false) {
      $this->load->view("templates/header_admin", $data);
      $this->load->view("templates/sidebar_admin", $data);
      $this->load->view("templates/topbar_admin", $data);
      $this->load->view("admin/index", $data);
      $this->load->view("templates/footer_admin");
    } else {
      $image = $_FILES["image"]["name"];
      if ($image) {
        $config["allowed_types"] = "jpg|jpeg|png";
        $config["max_size"] = "2048";
        $config["upload_path"] = "./assets/img/event/";

        $this->load->library("upload", $config);

        if ($this->upload->do_upload("image")) {
          $img = $this->upload->data("file_name");
        } else {
          $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
          redirect('admin');
        }
      } else {
        $img = "default.jpg";
      }

      $dataEvent = [
        "image" => $img,
        "nama" => htmlspecialchars($this->input->post("nama", true)),
        "lokasi" => htmlspecialchars($this->input->post("lokasi", true)),
        "tanggal" => htmlspecialchars($this->input->post("tanggal", true)),
        "waktu" => htmlspecialchars($this->input->post("waktu", true)),
        "deskripsi" => $this->input->post("deskripsi", true),
        "data_donasi" => htmlspecialchars($this->input->post("data_donasi", true)),
        "maker" => "admin",
        "is_active" => 1
      ];

      $this->baksos->insertEvent($dataEvent);
      $this->session->set_flashdata("message", "<div class='alert alert-success' role='alert'>Data event tersimpan</div>");
      redirect("admin");
    }
  }

  public function pesertaEvent($id)
  {
    $username = $this->session->userdata("username");
    $data["title"] = "Admin BakSos";
    $data["menu_"] = "Manage data";
    $data["menu"] = $this->baksos->getAllAdminMenu();
    $data["admin"] = $this->baksos->getAdminWhere($username);
    $data["event"] = $this->baksos->getEventWhere($id);
    $data["peserta"] = $this->baksos->getPesertaWhere($id);

    $this->load->view("templates/header_admin", $data);
    $this->load->view("templates/sidebar_admin", $data);
    $this->load->view("templates/topbar_admin", $data);
    $this->load->view("admin/pesertaevent", $data);
    $this->load->view("templates/footer_admin");
  }

  public function editEvent($id)
  {
    $username = $this->session->userdata("username");
    $data["title"] = "Admin BakSos";
    $data["menu_"] = "Manage data";
    $data["menu"] = $this->baksos->getAllAdminMenu();
    $data["admin"] = $this->baksos->getAdminWhere($username);
    $data["dataEventEdit"] = $this->baksos->getEventWhere($id);

    $this->form_validation->set_rules("nama", "nama", "required|trim");
    $this->form_validation->set_rules("lokasi", "lokasi", "required|trim");
    $this->form_validation->set_rules("tanggal", "tanggal", "required|trim");
    $this->form_validation->set_rules("waktu", "waktu", "required|trim");
    $this->form_validation->set_rules("deskripsi", "deskripsi", "required|trim");
    $this->form_validation->set_rules("data_donasi", "data donasi", "required|trim");

    if ($this->form_validation->run() == false) {
      $this->load->view("templates/header_admin", $data);
      $this->load->view("templates/sidebar_admin", $data);
      $this->load->view("templates/topbar_admin", $data);
      $this->load->view("admin/editevent", $data);
      $this->load->view("templates/footer_admin");
    } else {
      $image = $_FILES["image"]["name"];
      $old_image = $data["dataEventEdit"]["image"];
      // $data_lomba = $this->baksos->getEventWhere($id);
      if ($image) {
        $config["allowed_types"] = "jpg|jpeg|png";
        $config["max_size"] = "2048";
        $config["upload_path"] = "./assets/img/event/";

        $this->load->library("upload", $config);

        if ($this->upload->do_upload("image")) {
          if ($old_image != "default.jpg") {
            unlink(FCPATH . "assets/img/event/" . $old_image);
          }

          $new_image = $this->upload->data("file_name");
          // $this->db->set("image", $new_image);
        } else {
          $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
          redirect('admin');
        }
      } else {
        $new_image = $old_image;
      }

      $dataEvent = [
        "id" => $id,
        "image" => $new_image,
        "nama" => htmlspecialchars($this->input->post("nama", true)),
        "lokasi" => htmlspecialchars($this->input->post("lokasi", true)),
        "tanggal" => htmlspecialchars($this->input->post("tanggal", true)),
        "waktu" => htmlspecialchars($this->input->post("waktu", true)),
        "deskripsi" => htmlspecialchars($this->input->post("deskripsi", true)),
        "data_donasi" => htmlspecialchars($this->input->post("data_donasi", true))
      ];

      $this->baksos->updateEvent($dataEvent);
      $this->session->set_flashdata("message", "<div class='alert alert-success' role='alert'><b>" . $data["dataEventEdit"]["nama"] . "</b> data has been changed!</div>");
      redirect("admin");
    }
  }

  public function changeActivationEvent()
  {
    $dataEventWhere = $this->baksos->getEventWhere($this->input->post("id", true));
    if ($dataEventWhere["is_active"] == 0) {
      $this->db->where("id", $dataEventWhere["id"]);
      $this->db->update("event", ["is_active" => 1]);
      $this->session->set_flashdata("message", "<div class='alert alert-success' role='alert'><b>" . $dataEventWhere["nama"] . "</b> data has been activated!</div>");
    } else {
      $this->db->where("id", $dataEventWhere["id"]);
      $this->db->update("event", ["is_active" => 0]);
      $this->session->set_flashdata("message", "<div class='alert alert-danger' role='alert'><b>" . $dataEventWhere["nama"] . "</b> data has been diactivated!</div>");
    }
  }

  public function deleteEvent($id)
  {
    $dataEvent = $this->baksos->getEventWhere($id);
    if ($dataEvent["image"] != "default.jpg") {
      unlink(FCPATH . "assets/img/event/" . $dataEvent["image"]);
    }
    $this->baksos->deleteEvent($id);
    $this->session->set_flashdata("message", "<div class='alert alert-success' role='alert'>Data event dihapus!</div>");
    redirect("admin");
  }
}
