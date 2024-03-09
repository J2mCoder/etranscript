document.addEventListener('DOMContentLoaded', function () {

  const urlParams = new URLSearchParams(window.location.search);
  const departmentId = urlParams.get('departement_update');
  const deletedepartmentId = urlParams.get('department_delete');
  const Add_Departement = urlParams.get('Add_Departement');
  const Add_faculte = urlParams.get('Add_faculte');
  const deletefaculte = urlParams.get('faculte_delete');
  const faculte_update = urlParams.get('faculte_update');

  if (faculte_update) {
    $('#faculte_update').modal('show');
  }

  if (departmentId) {
    $('#Modify_Departement').modal('show');
  }

  if (deletedepartmentId) {
    $('#Delete_Departement').modal('show');
  }

  if (deletefaculte) {
    $('#Delete_faculte').modal('show');
  }

  if (Add_Departement) {
    $('#AddDepartement').modal('show');
  }

  if (Add_faculte) {
    $('#AddFaculte').modal('show');
  }

  $('#faculte_update').on('hidden.bs.modal', function () {
    history.replaceState(null, null, window.location.pathname);
  });

  $('#AddFaculte').on('hidden.bs.modal', function () {
    history.replaceState(null, null, window.location.pathname);
  });

  $('#Modify_Departement').on('hidden.bs.modal', function () {
    history.replaceState(null, null, window.location.pathname);
  });

  $('#Delete_Departement').on('hidden.bs.modal', function () {
    history.replaceState(null, null, window.location.pathname);
  });

  $('#AddDepartement').on('hidden.bs.modal', function () {
    history.replaceState(null, null, window.location.pathname);
  });

  $('#AddFaculte').on('hidden.bs.modal', function () {
    history.replaceState(null, null, window.location.pathname);
  });
  $('#Delete_faculte').on('hidden.bs.modal', function () {
    history.replaceState(null, null, window.location.pathname);
  });

});