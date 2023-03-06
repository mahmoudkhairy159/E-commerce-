
<!-- Vendor JS Files -->
<script src="{{asset('vendor/apexcharts/apexcharts.min.js')}}"></script>
<script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('vendor/chart.js/chart.min.js')}}"></script>
<script src="{{asset('vendor/echarts/echarts.min.js')}}"></script>
<script src="{{asset('vendor/quill/quill.min.js')}}"></script>
<script src="{{asset('vendor/simple-datatables/simple-datatables.js')}}"></script>
<script src="{{asset('vendor/php-email-form/validate.j')}}s"></script>

<!-- Template Main JS File -->
<script src="{{asset('js/app.js')}}"></script>

<!-- bootstrap JS  -->
<script src="{{asset('js/jquery-3.4.1.min.js')}}"></script>
<script src="{{asset('js/popper.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>

<script>
    function changeImage(element) {
        var main_prodcut_image = document.getElementById('main_product_image');
        main_prodcut_image.src = element.src;
    }
</script>

<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@2.8.2/dist/alpine.min.js"></script>



<script>
    $(document).on('change','#VISA',function(e){
        e.preventDefault();
        $.ajax({
            type:'get',
            url:"{{route('prepareCheckout')}}",
            data: {
                totalPrice:$('#totalPrice').val(),
            },
            success:function(data){
                if(data.status ==true){
                    $('#showVisaPaymentForm').empty().html(data.content);
                }else{
                    $('#failModal').modal('toggle');
                }
            },
            error:function(reject){

            }
        });
    });

    //VISA radio button is checked
</script>


<script src="https://js.pusher.com/7.2/pusher.min.js"></script>
<script>
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('9a82aa12edbfc880a1af', {
        cluster: 'mt1'
    });

    var channel = pusher.subscribe('new-notify');
    channel.bind('App\\Events\\NewNotification', function(data) {
        console.log(data);
    });
</script>


