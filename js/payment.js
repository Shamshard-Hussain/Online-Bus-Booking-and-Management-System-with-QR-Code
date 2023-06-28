const cleaveCC = new Cleave("#cardNumber", {
  creditCard: true,
  delimiter: "-",
});

const cleaveDate = new Cleave("#cardExpiry", {
  date: true,
  datePattern: ["m", "y"],
});

const cleaveCCV = new Cleave("#cardCcv", {
  blocks: [3],
});

