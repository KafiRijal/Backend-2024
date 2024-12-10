/**
 * TODO 9:
 * - Import semua method FruitController
 * - Refactor variable ke ES6 Variable
 *
 * @hint - Gunakan Destructing Object
 */

const {
  index,
  store,
  update,
  destroy,
} = require("./controller/FruitController");
/**
 * NOTES:
 * - Fungsi main tidak perlu diubah
 * - Jalankan program: node app.js
 */
const main = () => {
  console.log("Method index - Menampilkan Buah");
  index();
  console.log("\nMethod store - Menambahkan buah Manggis");
  store("Manggis");
  console.log("\nMethod update - Update data 0 menjadi Melon");
  update(0, "Melon");
  console.log("\nMethod destroy - Menghapus data 0");
  destroy(0);
};

main();
