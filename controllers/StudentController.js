// import Model Student
const Student = require("../models/Student");

class StudentController {
  // menambahkan keyword async
  async index(req, res) {
    const students = await Student.all();
    if (students && students.length > 0) {
      const data = {
        message: "Menampilkan semua students",
        data: students,
      };
      return res.status(200).json(data);
    } else {
      const data = {
        message: "Data students kosong",
      };
      return res.status(200).json(data);
    }
  }

  async store(req, res) {
    /**
     * TODO 2: memanggil method create.
     * Method create mengembalikan data yang baru diinsert.
     * Mengembalikan response dalam bentuk json.
     */
    const { nama, nim, email, jurusan } = req.body;

    if (!nama || !nim || !email || !jurusan) {
      const data = {
        message: "Data student harus diisi semua",
      };
      return res.status(422).json(data);
    }
    const student = await Student.create(req.body);
    const data = {
      message: "Menambahkan data students",
      data: student,
    };
    return res.status(201).json(data);
  }

  async update(req, res) {
    const { id } = req.params;
    // mencari id student yang mau diupdate
    const student = await Student.find(id);

    if (student) {
      // melakukan update data
      const student = await Student.update(id, req.body);
      const data = {
        message: `Mengedit data students`,
        data: student,
      };
      res.status(200).json(data);
    } else {
      const data = {
        message: `student not found`,
      };
      res.status(404).json(data);
    }
  }

  async destroy(req, res) {
    const { id } = req.params;
    // mencari id student yang mau dihapus
    const student = await Student.find(id);

    if (student) {
      // melakukan hapus data
      await Student.delete(id);
      const data = {
        message: `Menghapus data student id ${id}`,
      };
      res.status(200).json(data);
    } else {
      const data = {
        message: `student not found`,
      };
      res.status(404).json(data);
    }
  }

  async show(req, res) {
    const { id } = req.params;
    // mencari id student yang mau ditampilkan
    const student = await Student.find(id);

    if (student) {
      const data = {
        message: `Menampilkan student id ${id}`,
        data: student,
      };
      res.status(200).json(data);
    } else {
      const data = {
        message: `student not found`,
      };
      res.status(404).json(data);
    }
  }
}
// Membuat object StudentController
const object = new StudentController();

// Export object StudentController
module.exports = object;
