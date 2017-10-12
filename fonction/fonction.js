

var liste = [
    "Draggable",
    "Droppable",
    "Resizable",
    "Selectable",
    "Sortable"
];

$('#search').autocomplete({
    source : liste,

    minLength : 1,
});



function lienPlat(){

  return plat;
}
