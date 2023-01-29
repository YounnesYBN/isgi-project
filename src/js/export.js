var table2excel = new Table2Excel();
document.getElementById("btn-valide").addEventListener("click", () => {
  let AllInputNumber = document.querySelectorAll("input[type='number']");
  AllInputNumber.forEach((Element) => {
    Element.type = "text";
  });
  table2excel.export(document.getElementById("tableGenerale"));
  AllInputNumber.forEach((Element) => {
    Element.type = "number";
  });

  location.reload();
});
