<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.1.0/dist/select2-bootstrap-5-theme.min.css" />
    <!-- Or for RTL support -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.1.0/dist/select2-bootstrap-5-theme.rtl.min.css" />
    
    <title>@yield('title')</title>
    <style>
        #dashboard-menu {
            position: fixed;
            height: 100%;
            
        }

        #alert-container {
            position: fixed;
            top: 70px;
            right: 20px;
            z-index: 10000;
            
        }
        .table-striped tr:nth-child(odd) {
            background-color: #f8f9fa;
        }

        .table-striped th {
            background-color: #dee2e6;
        }
        .btn-icon {
            border: none;
        }

       


        @media screen and (max-width:991px) {
            #dashboard-menu {
                height: auto;
                width: 100%;
            }

            #main-content {
                margin-top: 60px;
            }
        }

        @media screen and (max-width:500px) {
            .header-name {
                display: none;
            }

        }
    </style>
</head>

<body>
    @include('admin.include.header')
    @include('admin.include.slider')
    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- use ckeditor -->
    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>

    


    <script>
        function previewAvatar(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('avatar-preview');
                output.src = reader.result;
                output.style.display = 'block';
            };
            reader.readAsDataURL(event.target.files[0]);
        }

        function previewModalAvatar(event) {
            var reader = new FileReader();
            reader.onload =function() {
                var output =document.getElementById('modal-avatar-preview');
                output.src =reader.result;
                output.style.display = 'block';
            };
            reader.readAsDataURL(event.target.files[0]);
        }

        $(document).ready(function() {
            $('#multiple-select-custom-field').select2({
                theme: "bootstrap-5",
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                placeholder: $(this).data('placeholder'),
                closeOnSelect: false,
                tags: true
            });
        });

        window.setTimeout(function () {
            $("#alert-container").fadeTo(500, 0).slideUp(500, function () {
                $(this).remove();
            });
        }, 3500);

        function toggle(source) {
            checkboxes = document.getElementsByName('ids[]');
            for(var i=0, n=checkboxes.length;i<n;i++) {
                checkboxes[i].checked = source.checked;
            }
        }

        CKEDITOR.replace('description');

    </script>

    <script>
        $('#example').DataTable({
            ajax: 'data/arrays.txt'
        });
    </script>



</body>

</html>