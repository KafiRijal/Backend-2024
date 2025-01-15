// import database
const db = require("../config/database");

// membuat class Alumni
class Alumni {
  // fungsi untuk mendapatkan semua data alumni
  static all() {
    return new Promise((resolve, reject) => {
      const sql = "SELECT * FROM alumni";
      db.query(sql, (err, results) => {
        if (err) reject(err);
        resolve(results);
      });
    });
  }

  // fungsi untuk membuat data alumni baru
  static async create(data) {
    const id = await new Promise((resolve, reject) => {
      const sql = "INSERT INTO alumni SET ?";
      db.query(sql, data, (err, results) => {
        if (err) reject(err);
        resolve(results.insertId);
      });
    });
    const alumni = await this.find(id);
    return alumni;
  }

  // fungsi untuk memperbarui data alumni berdasarkan id
  static async update(id, data) {
    await new Promise((resolve, reject) => {
      const sql = "UPDATE alumni SET ? WHERE id = ?";
      db.query(sql, [data, id], (err, results) => {
        if (err) reject(err);
        resolve(results);
      });
    });
    const alumni = await this.find(id);
    return alumni;
  }

  // fungsi untuk menghapus data alumni berdasarkan id
  static delete(id) {
    return new Promise((resolve, reject) => {
      const sql = "DELETE FROM alumni WHERE id = ?";
      db.query(sql, id, (err, results) => {
        if (err) reject(err);
        resolve(results);
      });
    });
  }

  // fungsi untuk mencari data alumni berdasarkan id
  static find(id) {
    return new Promise((resolve, reject) => {
      const sql = "SELECT * FROM alumni WHERE id = ?";
      db.query(sql, id, (err, results) => {
        if (err) reject(err);
        const [alumni] = results;
        resolve(alumni);
      });
    });
  }

  // fungsi untuk mencari data alumni berdasarkan nama
  static search(name) {
    return new Promise((resolve, reject) => {
      const sql = "SELECT * FROM alumni WHERE name LIKE ?";
      db.query(sql, [`%${name}%`], (err, results) => {
        if (err) reject(err);
        const [alumni] = results;
        resolve(alumni);
      });
    });
  }

  // fungsi untuk mencari data alumni berdasarkan status
  static findByStatus(status) {
    return new Promise((resolve, reject) => {
      const sql = "SELECT * FROM alumni WHERE status = ?";
      db.query(sql, status, (err, results) => {
        if (err) reject(err);
        const [alumni] = results;
        resolve(alumni);
      });
    });
  }

  // fungsi untuk menghitung jumlah data alumni berdasarkan status
  static countByStatus(status) {
    return new Promise((resolve, reject) => {
      const sql = "SELECT COUNT(*) AS total FROM alumni WHERE status LIKE ?";
      db.query(sql, [`%${status}%`], (err, results) => {
        if (err) reject(err);
        resolve(results[0].total);
      });
    });
  }
}

// export class Alumni
module.exports = Alumni;
