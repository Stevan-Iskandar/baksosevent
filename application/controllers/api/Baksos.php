<?php

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class Baksos extends REST_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model("Baksos_model", "baksos");
  }

  // ========================= EVENT =========================
  public function getEvent_get()
  {
    $allEvent = $this->baksos->getAllEvent();
    $this->response($allEvent, REST_Controller::HTTP_OK);
  }

  public function postEventt_post()
  {
    $image = $_FILES["image"]["name"];
    if ($image) {
      $config["allowed_types"] = "jpg|jpeg|png";
      $config["max_size"] = "2048";
      $config["upload_path"] = "./assets/img/event/";

      $this->load->library("upload", $config);

      if ($this->upload->do_upload("image")) {
        $img = $this->upload->data("file_name");
      }
    } else {
      $img = "default.jpg";
    }

    $dataEvent = [
      "image" => $img,
      "nama" => htmlspecialchars($this->post("nama")),
      "lokasi" => htmlspecialchars($this->post("lokasi")),
      "tanggal" => htmlspecialchars($this->post("tanggal")),
      "waktu" => htmlspecialchars($this->post("waktu")),
      "deskripsi" => htmlspecialchars($this->post("deskripsi")),
      "data_donasi" => htmlspecialchars($this->post("data_donasi")),
      "maker" => $this->post("username"),
      "is_active" => 0
    ];

    $this->baksos->insertEvent($dataEvent);
    $this->response([
      "status" => TRUE,
      "message" => "Event berhasil dibuat"
    ], REST_Controller::HTTP_CREATED);
  }

  // ========================= USER =========================

  public function setUser_post()
  {
    $type = $this->post("type");
    $dataUser = [
      "username" => htmlspecialchars($this->post("username")),
      "password" => password_hash($this->post("password"), PASSWORD_DEFAULT),
      "nama" => htmlspecialchars($this->post("nama")),
      "email" => htmlspecialchars($this->post("email")),
      "alamat" => htmlspecialchars($this->post("alamat")),
      "tlp" => htmlspecialchars($this->post("tlp"))
    ];

    if ($type == "insert") {
      $this->baksos->insertUser($dataUser);
      $this->response($dataUser, REST_Controller::HTTP_CREATED);
    } else {
      $this->baksos->updateUser($dataUser);
      $this->response($dataUser, REST_Controller::HTTP_CREATED);
    }
  }

  public function loginUser_post()
  {
    $username = $this->post("username");
    $password = $this->post("password");

    $user = $this->baksos->getUserWhere($username);

    if ($user) {
      if (password_verify($password, $user["password"])) {
        $this->response([
          "status" => TRUE,
          "message" => $user["username"]
        ], REST_Controller::HTTP_OK);
      } else {
        $this->response([
          "status" => FALSE,
          "message" => "Wrong password"
        ], REST_Controller::HTTP_OK);
      }
    } else {
      $this->response([
        "status" => FALSE,
        "message" => "No users were found"
      ], REST_Controller::HTTP_NOT_FOUND);
    }
  }

  public function daftarPeserta_post()
  {
    $dataPeserta = [
      "id_event" => $this->post("id_event"),
      "username" => $this->post("username")
    ];
    $this->baksos->daftarPeserta($dataPeserta);

    $this->response($dataPeserta, REST_Controller::HTTP_CREATED);
  }

  public function getAllPesertaWhere_get()
  {
    $id_event = $this->get("id_event");
    $peserta = $this->baksos->getPesertaWhere($id_event);
    $this->response($peserta, REST_Controller::HTTP_OK);
  }

  public function daftarEvent_post()
  {
    $daftar = [
      "id_event" => $this->post("id_event"),
      "username" => $this->post("username")
    ];
    $cekDataDaftar = $this->baksos->getDataDaftarWhere($daftar);

    if ($cekDataDaftar) {
      if ($cekDataDaftar["is_registered"] == 1) {
        $this->db->set("is_registered", 0);
        $this->baksos->updateDataDaftar($cekDataDaftar);
        $this->response([
          "status" => TRUE,
          "message" => "Anda sudah tidak terdaftar"
        ], REST_Controller::HTTP_OK);
      } else {
        $this->db->set("is_registered", 1);
        $this->baksos->updateDataDaftar($cekDataDaftar);
        $this->response([
          "status" => TRUE,
          "message" => "Berhasil terdaftar kembali"
        ], REST_Controller::HTTP_OK);
      }
    } else {
      $daftar["is_registered"] = 1;
      $this->baksos->daftarEvent($daftar);
      $this->response([
        "status" => TRUE,
        "message" => "Berhasil daftar"
      ], REST_Controller::HTTP_CREATED);
    }
  }



  public function getPeserta_get()
  {
    $dataPeserta = $this->baksos->getPeserta();
    $this->response($dataPeserta, REST_Controller::HTTP_OK);
  }

  public function getPesertaa_get()
  {
    $dataPeserta = $this->baksos->getPesertaWhere(1);
    $dataEvent = $this->baksos->getEventWhere($dataPeserta["id_event"]);
    $datauser = $this->baksos->getUserWhere($dataPeserta["username"]);
    $this->response([
      "peserta" => [
        "id" => $dataPeserta["id"],
        "id_event" => $dataEvent,
        "username" => $datauser
      ]
    ], REST_Controller::HTTP_OK);
  }

  public function selfie_post()
  {
    $image = $_FILES["image"]["name"];
    if ($image) {
      $config["allowed_types"] = "jpg|jpeg|png";
      $config["max_size"] = "2048";
      $config["upload_path"] = "./assets/img/selfie/";

      $this->load->library("upload", $config);

      if ($this->upload->do_upload("image")) {
        $img = $this->upload->data("file_name");
      }
    } else {
      $img = "default.jpg";
    }

    $dataCris = [
      "image" => $img,
      "latitude" => htmlspecialchars($this->post("latitude")),
      "longitude" => htmlspecialchars($this->post("longitude")),
      "address" => htmlspecialchars($this->post("address")),
      "time" => htmlspecialchars($this->post("time"))
    ];

    $this->db->insert("cris", $dataCris);
    $this->response([
      "status" => TRUE,
      "message" => "Data berhasil dikirim"
    ], REST_Controller::HTTP_CREATED);
  }
}
