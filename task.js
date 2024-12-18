/**
 * Menampilkan informasi setelah proses download selesai
 * @param {string} result - Nama file hasil download
 */
const showDownload = (result) => {
  console.log("Download selesai");
  console.log(`Hasil Download: ${result}`);
};

/* Fungsi untuk menampilkan proses download file menggunakan Promise */
const download = () => {
  return new Promise((resolve) => {
    setTimeout(() => {
      const result = "windows-10.exe";
      resolve(result);
    }, 3000);
  });
};

/**
 * Fungsi utama untuk menjalankan proses download
 * menggunakan Async/Await
 */
const main = async () => {
  try {
    const result = await download();
    showDownload(result); // Menampilkan hasil download
  } catch (error) {
    console.error("Terjadi kesalahan saat mendownload file:", error); // Menampilkan error jika terjadi masalah saat proses download
  }
};

main();

/**
 * TODO:
 * - Refactor callback ke Promise atau Async Await
 * - Refactor function ke ES6 Arrow Function
 * - Refactor string ke ES6 Template Literals
 */
