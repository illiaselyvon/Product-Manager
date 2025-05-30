        </div> <!-- /.container -->
        <footer class="tm-footer row tm-mt-small">
            <div class="col-12 font-weight-light">
                <p class="text-center text-white mb-0 px-4 small">
                    Copyright &copy; <b>2018</b> All rights reserved.
                    Design: <a rel="nofollow noopener" href="https://templatemo.com" class="tm-footer-link">Template Mo</a>
                </p>
            </div>
        </footer>
    </div> <!-- /#home -->

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/moment.min.js"></script>
    <script src="js/Chart.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/tooplate-scripts.js"></script>
    <script>
        Chart.defaults.global.defaultFontColor = 'white';
        let ctxLine,
            ctxBar,
            ctxPie,
            optionsLine,
            optionsBar,
            optionsPie,
            configLine,
            configBar,
            configPie,
            lineChart;
        barChart, pieChart;
        $(function () {
            drawLineChart();
            drawBarChart();
            drawPieChart();

            $(window).resize(function () {
                updateLineChart();
                updateBarChart();
            });
        });
    </script>
</body>

</html>
