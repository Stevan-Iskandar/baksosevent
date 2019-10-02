<?php

class Baksos_model extends CI_Model
{
  // ========================= ADMIN =========================

  public function getAdmin()
  {
    return $this->db->get("admin")->result_array();
  }

  public function getAdminWhere($username)
  {
    return $this->db->get_where("admin", ["username" => $username])->row_array();
  }

  public function getAllAdminMenu()
  {
    return $this->db->get_where("admin_menu", ["is_active" => 1])->result_array();
  }

  // ========================= EVENT =========================

  public function getAllEvent()
  {
    return $this->db->get("event")->result_array();
  }

  public function getEventWhere($id)
  {
    return $this->db->get_where("event", ["id" => $id])->row_array();
  }

  public function insertEvent($dataEvent)
  {
    $this->db->insert("event", $dataEvent);
  }

  public function updateEvent($event)
  {
    $this->db->set("image", $event["image"]);
    $this->db->set("nama", $event["nama"]);
    $this->db->set("lokasi", $event["lokasi"]);
    $this->db->set("tanggal", $event["tanggal"]);
    $this->db->set("waktu", $event["waktu"]);
    $this->db->set("deskripsi", $event["deskripsi"]);
    $this->db->set("data_donasi", $event["data_donasi"]);
    $this->db->where("id", $event["id"]);
    $this->db->update("event");
  }

  public function deleteEvent($id)
  {
    $this->db->delete("event", ["id" => $id]);
  }

  // ========================= USER =========================

  public function insertUser($insertDataUser)
  {
    $this->db->insert("user", $insertDataUser);
  }

  public function getUserWhere($username)
  {
    return $this->db->get_where("user", ["username" => $username])->row_array();
  }

  public function updateUser($user)
  {
    $this->db->set("password", $user["password"]);
    $this->db->set("nama", $user["nama"]);
    $this->db->set("email", $user["email"]);
    $this->db->set("alamat", $user["alamat"]);
    $this->db->set("tlp", $user["tlp"]);
    $this->db->where("username", $user["username"]);
    $this->db->update("user");
  }

  // ========================= PESERTA =========================

  public function getPeserta()
  {
    return $this->db->get("peserta")->result_array();
  }

  public function getPesertaWhere($id_event)
  {
    return $this->db->get_where("peserta", ["id_event" => $id_event])->result_array();
  }

  public function getDataDaftarWhere($daftar)
  {
    return $this->db->get_where("peserta", [
      "id_event" => $daftar["id_event"],
      "username" => $daftar["username"]
    ])->row_array();
  }

  public function updateDataDaftar($dataDaftar)
  {
    $this->db->where("id", $dataDaftar["id"]);
    $this->db->update("peserta");
  }

  public function daftarEvent($daftar)
  {
    return $this->db->insert("peserta", $daftar);
  }
}
