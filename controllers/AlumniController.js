// import Model Alumni
const Alumni = require("../models/Alumni");

// buat class AlumniController
class AlumniController {
  // Fungsi untuk mendapatkan semua data alumni
  async index(req, res) {
    // Menggunakan method "all()" dari model Alumni untuk mengambil semua data
    const alumni = await Alumni.all();
    // Jika data alumni kosong atau tidak ditemukan
    if (!alumni || alumni.length === 0) {
      // Jika data kosong, mengirim respons status 404
      const data = {
        message: "Data is empty",
      };
      return res.status(404).json(data);
    }

    // Jika data ditemukan, mengirim respons status 200
    const data = {
      message: "Get All Resource",
      data: alumni,
    };

    return res.status(200).json(data);
  }
  // Fungsi untuk menambahkan data alumni
  async store(req, res) {
    // Mengambil data yang dikirim melalui body request
    const {
      name,
      phone,
      address,
      graduation_year,
      status,
      company_name,
      position,
    } = req.body;

    // Validasi input data
    if (
      !name ||
      !phone ||
      !address ||
      !graduation_year ||
      !status ||
      !company_name ||
      !position
    ) {
      // Jika ada field yang kosong, mengirim respons status 422
      const data = {
        message: "All fields must be filled correctly",
      };
      return res.status(422).json(data);
    }
    // Menambahkan data baru menggunakan method "create()" dari model Alumni
    const alumni = await Alumni.create(req.body);
    // Jika data berhasil ditambahkan, mengirim respons status 201
    const data = {
      message: "Resource is added successfully",
      data: alumni,
    };
    return res.status(201).json(data);
  }

  // Fungsi untuk mengupdate data alumni menggunakan parameter id
  async update(req, res) {
    // Mendapatkan id dari parameter
    const { id } = req.params;
    // Mencari id alumni yang mau diupdate
    const alumni = await Alumni.find(id);

    if (!alumni) {
      // Jika data tidak ditemukan, mengirim respons status 404
      const data = {
        message: "Resource not found",
      };
      res.status(404).json(data);
    }
    // Memperbarui data alumni berdasarkan id dan data baru dari body request
    const update_alumni = await Alumni.update(id, req.body);
    // Jika data berhasil diupdate, mengirim respons status 200
    const data = {
      message: "Resource is updated successfully",
      data: update_alumni,
    };
    res.status(200).json(data);
  }

  // Fungsi untuk menghapus data alumni menggunakan parameter id
  async destroy(req, res) {
    // Mendapatkan id dari parameter
    const { id } = req.params;
    // Mencari id alumni yang mau dihapus
    const alumni = await Alumni.find(id);

    if (alumni) {
      // Jika data tidak ditemukan, mengirim respons status 404
      const data = {
        message: "Resource not found",
      };
      res.status(404).json(data);
    }
    // Menghapus data alumni berdasarkan id
    await Alumni.delete(id);
    // Jika data berhasil dihapus, mengirim respons status 200
    const data = {
      message: "Resource is delete successfully",
    };
    res.status(200).json(data);
  }

  // Fungsi untuk menampilkan detail data alumni menggunakan parameter id
  async show(req, res) {
    // Mendapatkan id dari parameter
    const { id } = req.params;
    // Mencari id alumni yang mau ditampilkan
    const alumni = await Alumni.find(id);

    if (!alumni) {
      // Jika data tidak ditemukan, mengirim respons status 404
      const data = {
        message: "Resource not found",
      };
      res.status(404).json(data);
    }
    // Jika data berhasil ditemukan, mengirim respons status 200
    const data = {
      message: "Get Detail Resource",
      data: alumni,
    };
    res.status(200).json(data);
  }

  // Fungsi untuk mencari data alumni menggunakan parameter nama
  async search(req, res) {
    // Mendapatkan nama dari parameter
    const { name } = req.params;
    // Mencari nama alumni yang mau ditampilkan
    const alumni = await Alumni.search(name);

    if (!alumni) {
      // Jika data tidak ditemukan, mengirim respons status 404
      const data = {
        message: "Resource not found",
      };
      res.status(404).json(data);
    }
    // Jika data berhasil ditemukan, mengirim respons status 200
    const data = {
      message: "Get Searched Resource",
      data: alumni,
    };
    res.status(200).json(data);
  }

  // Fungsi untuk mendapatkan data alumni dengan status fresh graduate
  async freshGraduate(req, res) {
    // Mendapatkan status fresh-graduate
    const status = "fresh-graduate";
    // Mencari status alumni yang mau ditampilkan
    const alumni = await Alumni.findByStatus(status);
    // Menghitung total status alumni yang ditampilkan
    const total_alumni = await Alumni.countByStatus(status);

    if (!alumni) {
      // Jika data tidak ditemukan, mengirim respons status 404
      const data = {
        message: "Resource not found",
      };
      res.status(404).json(data);
    }
    // Jika data berhasil ditemukan, mengirim respons status 200
    const data = {
      message: "Get Searched Resource",
      data: alumni,
      total: total_alumni,
    };
    res.status(200).json(data);
  }

  // Fungsi untuk mendapatkan data alumni dengan status employed
  async employed(req, res) {
    // Mendapatkan status employed
    const status = "employed";
    // Mencari status alumni yang mau ditampilkan
    const alumni = await Alumni.findByStatus(status);
    // Menghitung total status alumni yang ditampilkan
    const total_alumni = await Alumni.countByStatus(status);

    if (!alumni) {
      // Jika data tidak ditemukan, mengirim respons status 404
      const data = {
        message: "Resource not found",
      };
      res.status(404).json(data);
    }
    // Jika data berhasil ditemukan, mengirim respons status 200
    const data = {
      message: "Get Searched Resource",
      data: alumni,
      total: total_alumni,
    };
    res.status(200).json(data);
  }

  // Fungsi untuk mendapatkan data alumni dengan status unemployed
  async unemployed(req, res) {
    // Mendapatkan status employed
    const status = "unemployed";
    // Mencari status alumni yang mau ditampilkan
    const alumni = await Alumni.findByStatus(status);
    // Menghitung total status alumni yang ditampilkan
    const total_alumni = await Alumni.countByStatus(status);

    if (!alumni) {
      // Jika data tidak ditemukan, mengirim respons status 404
      const data = {
        message: "Resource not found",
      };
      res.status(404).json(data);
    }
    // Jika data berhasil ditemukan, mengirim respons status 200
    const data = {
      message: "Get Searched Resource",
      data: alumni,
      total: total_alumni,
    };
    res.status(200).json(data);
  }
}

// membuat object AlumniController
const object = new AlumniController();

// export object AlumniController
module.exports = object;
