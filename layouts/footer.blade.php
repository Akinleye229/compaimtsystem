
<!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Wrapper -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- All Jquery -->
<!-- ============================================================== -->
<script src="{{ asset('files/assets/plugins/jquery/jquery.min.js') }}"></script>
<script>
    $(document).ready(function () {
        $(".qa_form").submit(function (e) {
            $(this).find("label.form_submit_error").text("");

            var select = $(this).find("select.qa_form_select");

            if($(select).val() == ""){
                e.preventDefault();
                $(this).find("label.form_submit_error").text("Please Select QA Specialist").css({'color':'red'});
            }
        });

        $(".acknowledgement_form").submit(function (e) {
            $(this).find("label.form_submit_error").text("");

            var textarea = $(this).find("textarea.acknowledgement");

            if($(textarea).val() == ""){
                e.preventDefault();
                $(this).find("label.form_submit_error").text("Please provide acknowledgement letter").css({'color':'red'});
            }
        });
    });
</script>
<!-- Bootstrap tether Core JavaScript -->
<script src="{{ asset('files/assets/plugins/bootstrap/js/tether.min.js') }}"></script>
<script src="{{ asset('files/assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
<!-- slimscrollbar scrollbar JavaScript -->
<script src="{{ asset('files/js/jquery.slimscroll.js') }}"></script>
<!--Wave Effects -->
<script src="{{ asset('files/js/waves.js') }}"></script>
<!--Menu sidebar -->
<script src="{{ asset('files/js/sidebarmenu.js') }}"></script>
<!--stickey kit -->
<script src="{{ asset('files/assets/plugins/sticky-kit-master/dist/sticky-kit.min.js') }}"></script>
<!--Custom JavaScript -->
<script src="{{ asset('files/js/custom.min.js') }}"></script>
<!-- ============================================================== -->
<!-- This page plugins -->
<!-- ============================================================== -->
<!-- chartist chart -->
<script src="{{ asset('files/assets/plugins/chartist-js/dist/chartist.min.js') }}"></script>
<script src="{{ asset('files/assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js') }}"></script>
<!--c3 JavaScript -->
<script src="{{ asset('files/assets/plugins/d3/d3.min.js') }}"></script>
<script src="{{ asset('files/assets/plugins/c3-master/c3.min.js') }}"></script>
<!-- Chart JS -->
<script src="{{ asset('files/js/dashboard1.js') }}"></script>


</body>

</html>
