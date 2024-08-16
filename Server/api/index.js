const express = require("express");
const bodyParser = require("body-parser");
const cors = require("cors");
const products = require("../products");

const app = express();
app.use(express.static("public"));
app.use(express.json());
app.use(cors());
app.use(bodyParser.urlencoded({ extended: true }));
const PORT = process.env.PORT || 3000;

app.get("/", async (req, res) => {
  res.send("Hej hopp");
});

app.get("/products", async (req, res) => {
  res.send(products);
});

app.get("/products/:id", async (req, res) => {
  const product = products.find((p) => p.id === parseInt(req.params.id));
  if (!product) {
    return res.status(404).send("Product not found");
  }
  res.send(product);
});

app.post("/products", async (req, res) => {
  if (!req.body.name || !req.body.price) {
    return res
      .status(400)
      .send(
        `Name and price are required. You sent: ${JSON.stringify(req.body)}`
      );
  }

  const product = {
    id: products.length + 1,
    name: req.body.name,
    price: req.body.price,
    imgUrl: req.body.imgUrl,
  };
  products.push(product);
  res.send(product);
});

app.put("/products", async (req, res) => {
  const product = products.find((p) => p.id === parseInt(req.body.id));
  if (!product) {
    return res.status(404).send("Product not found");
  }
  if (req.body.name) {
    product.name = req.body.name;
  }
  if (req.body.price) {
    product.price = req.body.price;
  }
  if (req.body.imgUrl) {
    product.img = req.body.imgUrl;
  }
  res.send(product);
});

app.delete("/products/", async (req, res) => {
  const product = products.find((p) => p.id === parseInt(req.body.id));
  if (!product) {
    return res.status(404).send("Product not found");
  }
  const index = products.indexOf(product);
  products.splice(index, 1);
  res.send(product);
});

app.listen(PORT, () => console.log(`Running on port ${PORT}`));
