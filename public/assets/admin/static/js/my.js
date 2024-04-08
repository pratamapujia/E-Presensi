// Sweet Alert
const berhasil = $(".flash-data").data("berhasil");
const gagal = $(".flash-data").data("gagal");
const Toast = Swal.mixin({
    toast: true,
    position: "top",
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener("mouseenter", Swal.stopTimer);
        toast.addEventListener("mouseleave", Swal.resumeTimer);
    },
});
if (berhasil) {
    Toast.fire({
        icon: "success",
        background: "#4E9F3D",
        iconColor: "#fff",
        color: "#fff",
        title: berhasil,
    });
}
if (gagal) {
    Toast.fire({
        icon: "error",
        background: "#FA7070",
        iconColor: "#fff",
        color: "#fff",
        title: gagal,
    });
}
