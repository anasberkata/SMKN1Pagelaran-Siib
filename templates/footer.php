<footer class="footer py-4  ">
    <div class="container-fluid">
        <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 mb-lg-0 mb-4">
                <div class="copyright text-center text-sm text-muted text-lg-start">
                    ©
                    <?= date("Y"); ?>.
                    Dev Beni Agustian.
                </div>
            </div>

        </div>
    </div>
</footer>
</div>
</main>

<script src="../vendor/simple-datatables/simple-datatables.js"></script>
<script>
    let data = document.querySelector('#data-table');
    let dataTable = new simpleDatatables.DataTable(data);
</script>

<script>
    var menuItems = document.getElementsByClassName('nav-link');
    for (var i = 0; i < menuItems.length; i++) {
        menuItems[i].addEventListener('click', function () {
            // Menghapus class 'active' dari semua menu-item
            for (var j = 0; j < menuItems.length; j++) {
                menuItems[j].classList.remove('bg-gradient-primary');
                menuItems[j].classList.remove('active');
            }

            // Menambahkan class 'active' ke menu-item yang diklik
            this.classList.add('bg-gradient-primary');
            this.classList.add('active');
        });
    }
</script>

<!--   Core JS Files   -->
<script src="../assets/js/core/popper.min.js"></script>
<script src="../assets/js/core/bootstrap.min.js"></script>
<script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
<script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
<script src="../assets/js/plugins/chartjs.min.js"></script>
<script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
</script>
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
<script src="../assets/js/material-dashboard.min.js?v=3.0.5"></script>
</body>

</html>