function InitComparisonTable(){
  const elements = document.querySelectorAll('.bultr-comp-table-wrap');
  if (elements.length > 0) {
    elements.forEach((element) => {
        const  isFilterable = element.getAttribute('data-table-filter');
        const  cols = element.getAttribute('data-cols');
      new Table({
        table: element,
        isFilterable,
        cols,
      });
    });
  }
}
document.addEventListener('DOMContentLoaded', function (t) {
  bricksIsFrontend && InitComparisonTable();
});