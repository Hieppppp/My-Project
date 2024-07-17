<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @include('admin.layouts.partials.style')
    @yield('styles')
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
    @include('admin.layouts.partials.header')
    @include('admin.layouts.partials.slider')
    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                @yield('content')
            </div>
        </div>
    </div>

    @include('admin.layouts.partials.scripts')
    @yield('scripts')

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
            reader.onload = function() {
                var output = document.getElementById('modal-avatar-preview');
                output.src = reader.result;
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

        window.setTimeout(function() {
            $("#alert-container").fadeTo(500, 0).slideUp(500, function() {
                $(this).remove();
            });
        }, 3500);

        function toggle(source) {
            checkboxes = document.getElementsByName('ids[]');
            for (var i = 0, n = checkboxes.length; i < n; i++) {
                checkboxes[i].checked = source.checked;
            }
        }

        CKEDITOR.replace('description');
    </script>

    <script>
        $(document).ready(function() {
            var table = $('#courses').DataTable({
                select: false,
                "columnDefs": [
                    {
                        "targets": [0,5],
                        "orderable": false,
                        "searchable": false,
                        "className": "text-center"

                    },
 
                ]
            }); 
        });

        $(document).ready(function() {
            var table = $('#users').DataTable({
                select: false,
                "columnDefs": [
                    {
                        "targets": [0,4],
                        "orderable": false,
                        "searchable": false,
                        "className": "text-center"

                    },
 
                ]
            }); 
        });
    </script>





</body>

</html>