angular.module('recipeApp', [])
.controller('MainCtrl', ['$window', '$scope', function($window, $scope){
const vm = this;


vm.recipes = [];
vm.pageSize = 6;
vm.currentPage = 1;
vm.defaultThumb = 'data:image/svg+xml;utf8,<svg>';


vm.form = {title:'', ingredients:'', instructions:'', image:null};


vm.saveToStorage = () => {
$window.localStorage.setItem('recipes_v1', JSON.stringify(vm.recipes));
};


vm.loadFromStorage = () => {
const raw = $window.localStorage.getItem('recipes_v1');
if(raw) vm.recipes = JSON.parse(raw);
};


vm.addRecipe = () => {
let r = angular.copy(vm.form);
r.id = Date.now();
r.ingredients = r.ingredients.split(',').map(s => s.trim());
r.createdAt = new Date();
vm.recipes.unshift(r);
vm.saveToStorage();
vm.resetForm();
};


vm.startEdit = (r) => {
vm.editing = true;
vm.editTarget = r;
vm.form = {
title: r.title,
ingredients: r.ingredients.join(', '),
instructions: r.instructions,
image: r.image
};
};


vm.saveEdit = () => {
let t = vm.editTarget;
t.title = vm.form.title;
t.ingredients = vm.form.ingredients.split(',').map(s => s.trim());
t.instructions = vm.form.instructions;
t.image = vm.form.image;
vm.saveToStorage();
vm.resetForm();
};


vm.deleteRecipe = (r) => {
vm.recipes = vm.recipes.filter(x => x.id !== r.id);
vm.saveToStorage();
};


vm.resetForm = () => {
vm.form = {title:'', ingredients:'', instructions:'', image:null};
vm.editing = false;
};


vm.viewRecipe = (r) => { vm.modalRecipe = r; vm.showModal = true; };
}]);