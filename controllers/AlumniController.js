// import Model Alumni
const Alumni = require("../models/Alumni");

// buat class AlumniController
class AlumniController {
  // fungsi untuk mendapatkan semua data alumni
  async index(req, res) {
    const alumni = await Alumni.all();
    if (alumni && alumni.length > 0) {
      const data = {
        message: "Get All Resource",
        data: alumni,
      };
      return res.status(200).json(data);
    } else {
      const data = {
        message: "Data is empty",
      };
      return res.status(200).json(data);
    }
  }
  // fungsi untuk menambahkan data alumni
  async store(req, res) {
    const {
      name,
      phone,
      address,
      graduation_year,
      status,
      company_name,
      position,
    } = req.body;

    //validasi input data
    if (
      !name ||
      !phone ||
      !address ||
      !graduation_year ||
      !status ||
      !company_name ||
      !position
    ) {
      const data = {
        message: "All fields must be filled correctly",
      };
      return res.status(422).json(data);
    }
    // menambahkan data alumni ke database
    const alumni = await Alumni.create(req.body);
    const data = {
      message: "Resource is added successfully",
      data: alumni,
    };
    return res.status(201).json(data);
  }

  // fungsi untuk mengupdate data alumni menggunakan parameter id
  async update(req, res) {
    const { id } = req.params;
    // mencari id alumni yang mau diupdate
    const alumni = await Alumni.find(id);

    if (alumni) {
      // melakukan update data
      const alumni = await Alumni.update(id, req.body);
      const data = {
        message: `Resource is updated successfully`,
        data: alumni,
      };
      res.status(200).json(data);
    } else {
      const data = {
        message: `Resource not found`,
      };
      res.status(404).json(data);
    }
  }

  // fungsi untuk menghapus data alumni menggunakan parameter id
  async destroy(req, res) {
    const { id } = req.params;
    // mencari id alumni yang mau dihapus
    const alumni = await Alumni.find(id);

    if (alumni) {
      // melakukan hapus data
      await Alumni.delete(id);
      const data = {
        message: `Resource is delete successfully`,
      };
      res.status(200).json(data);
    } else {
      const data = {
        message: `Resource not found`,
      };
      res.status(404).json(data);
    }
  }

  // fungsi untuk menampilkan detail data alumni menggunakan parameter id
  async show(req, res) {
    const { id } = req.params;
    // mencari id alumni yang mau ditampilkan
    const alumni = await Alumni.find(id);

    if (alumni) {
      const data = {
        message: `Get Detail Resource`,
        data: alumni,
      };
      res.status(200).json(data);
    } else {
      const data = {
        message: `Resource not found`,
      };
      res.status(404).json(data);
    }
  }

  // fungsi untuk mencari data alumni menggunakan parameter nama
  async search(req, res) {
    const { name } = req.params;
    // mencari nama alumni yang mau ditampilkan
    const alumni = await Alumni.search(name);

    if (alumni) {
      const data = {
        message: `Get Searched Resource`,
        data: alumni,
      };
      res.status(200).json(data);
    } else {
      const data = {
        message: `Resource not found`,
      };
      res.status(404).json(data);
    }
  }

  // fungsi untuk mendapatkan data alumni dengan status fresh graduate
  async freshGraduate(req, res) {
    const status = "fresh-graduate";
    // mencari status alumni yang mau ditampilkan
    const alumni = await Alumni.findByStatus(status);
    const total_alumni = await Alumni.countByStatus(status);

    if (alumni) {
      const data = {
        message: `Get fresh graduate resource`,
        data: alumni,
        total: total_alumni,
      };
      res.status(200).json(data);
    }
  }

  // fungsi untuk mendapatkan data alumni dengan status employed
  async employed(req, res) {
    const status = "employed";
    // mencari status alumni yang mau ditampilkan
    const alumni = await Alumni.findByStatus(status);
    const total_alumni = await Alumni.countByStatus(status);

    if (alumni) {
      const data = {
        message: `Get employed resource`,
        data: alumni,
        total: total_alumni,
      };
      res.status(200).json(data);
    }
  }

  // fungsi untuk mendapatkan data alumni dengan status unemployed
  async unemployed(req, res) {
    const status = "unemployed";
    // mencari status alumni yang mau ditampilkan
    const alumni = await Alumni.findByStatus(status);
    const total_alumni = await Alumni.countByStatus(status);

    if (alumni) {
      const data = {
        message: `Get unemployed resource`,
        data: alumni,
        total: total_alumni,
      };
      res.status(200).json(data);
    }
  }
}

// membuat object AlumniController
const object = new AlumniController();

// export object AlumniController
module.exports = object;
