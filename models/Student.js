// import database
const db = require("../config/database");

// membuat class Model Student
class Student {
  /**
   * Membuat method static all.
   */
  static all() {
    // return Promise sebagai solusi Asynchronous
    return new Promise((resolve, reject) => {
      const sql = "SELECT * from students";
      /**
       * Melakukan query menggunakan method query.
       * Menerima 2 params: query dan callback
       */
      db.query(sql, (err, results) => {
        resolve(results);
      });
    });
  }

  /**
   * TODO 1: Buat fungsi untuk insert data.
   * Method menerima parameter data yang akan diinsert.
   * Method mengembalikan data student yang baru diinsert.
   */
  static create(data) {
    return new Promise((resolve, reject) => {
      const sql =
        "INSERT INTO students (nama, nim, email, jurusan, created_at, updated_at) VALUES(?, ?, ?, ?, NOW(), NOW())";
      const values = [data.nama, data.nim, data.email, data.jurusan];

      db.query(sql, values, (err, result) => {
        if (err) {
          reject(err);
        } else
          resolve({
            id: result.insertId,
            nama: data.nama,
            nim: data.nim,
            email: data.email,
            jurusan: data.jurusan,
            created_at: new Date(),
            updated_at: new Date(),
          });
      });
    });
  }
}

// export class Student
module.exports = Student;
