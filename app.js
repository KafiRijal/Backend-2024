// import express and router
const express = require("express");
const router = require("./routes/api");

// buat object express
const app = express();

// menggunakan middleware
app.use(express.json());
app.use(express.urlencoded({ extended: true }));

// menggunakan router
app.use(router);

// mendefinisikan port
app.listen(3000);
