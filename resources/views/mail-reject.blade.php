<!doctype html>
<html lang="en" style="box-sizing: border-box;">
<head style="box-sizing: border-box;">
    <!-- Required meta tags -->
    <meta charset="utf-8" style="box-sizing: border-box;">
    <meta name="viewport" content="width=device-width, initial-scale=1" style="box-sizing: border-box;">

    <!-- Bootstrap CSS -->
    

    <link rel="preconnect" href="https://fonts.googleapis.com" style="box-sizing: border-box;">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin style="box-sizing: border-box;">
    

    

</head>
<body class="bg-light" style="box-sizing: border-box;margin: 0;font-family: var(--bs-body-font-family);font-size: var(--bs-body-font-size);font-weight: var(--bs-body-font-weight);line-height: var(--bs-body-line-height);color: var(--bs-body-color);text-align: var(--bs-body-text-align);background-color: rgba(var(--bs-light-rgb),var(--bs-bg-opacity))!important;-webkit-text-size-adjust: 100%;-webkit-tap-highlight-color: transparent;--bs-bg-opacity: 1;">
    <div class="d-flex justify-content-center" style="box-sizing: border-box;display: flex!important;justify-content: center!important;">
        <div class="col-11 col-md-6" style="box-sizing: border-box;flex: 0 0 auto;width: 50%;">
            {{-- <div class="text-center mt-3" style="box-sizing: border-box;margin-top: 1rem!important;text-align: center!important;">
                <h2 style="box-sizing: border-box;margin-top: 0;margin-bottom: .5rem;font-weight: 700;line-height: 1.2;font-size: calc(1.325rem + .9vw);font-family: 'Roboto', sans-serif;">Helpdesk</h2>
            </div> --}}
            <div class="card mt-5 px-2 border-0" style="box-sizing: border-box;position: relative;display: flex;flex-direction: column;min-width: 0;word-wrap: break-word;background-color: #fff;background-clip: border-box;border: 0!important;border-radius: .25rem;margin-top: 3rem!important;padding-right: .5rem!important;padding-left: .5rem!important;">
                <div class="card-body" style="box-sizing: border-box;flex: 1 1 auto;padding: 1rem 1rem;">
                    <div class="pb-1 mb-3 border-bottom" style="box-sizing: border-box;border-bottom: 1px solid #dee2e6!important;margin-bottom: 1rem!important;padding-bottom: .25rem!important;">
                        <h3 style="box-sizing: border-box;margin-top: 0;margin-bottom: .5rem;font-weight: 700;line-height: 1.2;font-size: calc(1.3rem + .6vw);font-family: 'Roboto', sans-serif;">Halo, {{$nama}}</h3>
                    </div>
                    <p style="box-sizing: border-box;margin-top: 0;margin-bottom: 1rem;font-family: 'Lora', serif;">Mohon maaf, permintaan registrasi Anda telah ditolak.</p>
                    <p style="box-sizing: border-box;margin-top: 0;margin-bottom: 1rem;font-family: 'Lora', serif;">Anda tetap bisa mengakses Aplikasi Helpdesk dan melihat daftar permasalahan beserta penyelesaian permasalahannya, namun Anda tidak bisa membuat tiket bantuan untuk permasalahan Anda.</p>
                    <p style="box-sizing: border-box;margin-top: 0;margin-bottom: 1rem;font-family: 'Lora', serif;">Jika Anda merasa bahwa ini adalah sebuah kesalahan, silakan hubungi Teknisi di Divisi Teknologi Informasi.</p>
                    <p style="box-sizing: border-box;margin-top: 0;margin-bottom: 1rem;font-family: 'Lora', serif;">Punya pertanyaan? Hubungi kami di <a href="mailto:admin@helpdesk.test" style="box-sizing: border-box;color: #0d6efd;text-decoration: underline;">admin@helpdesk.test</a>.</p>
                </div>
            </div>
            <div class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top" style="box-sizing: border-box;display: flex!important;border-top: 1px solid #dee2e6!important;flex-wrap: wrap!important;justify-content: space-between!important;align-items: center!important;margin-top: 1.5rem!important;margin-bottom: 1.5rem!important;padding-top: 1rem!important;padding-bottom: 1rem!important;">
                <div class="col-md-6 d-flex align-items-center" style="box-sizing: border-box;flex: 0 0 auto;width: 50%;display: flex!important;align-items: center!important;">
                    <span class="text-muted" style="font-family: 'Roboto', sans-serif;box-sizing: border-box;--bs-text-opacity: 1;color: #6c757d!important;">&copy; 2022 Riva Almero</span>
                </div>
            
                <ul class="nav col-md-6 justify-content-end list-unstyled d-flex" style="box-sizing: border-box;padding-left: 0;margin-top: 0;margin-bottom: 0;list-style: none;flex: 0 0 auto;width: 50%;display: flex!important;flex-wrap: wrap;justify-content: flex-end!important;">
                    <li class="ms-3" style="box-sizing: border-box;margin-left: 1rem!important;"><a class="text-muted" href="https://www.instagram.com/rivaalms" target="_blank" style="box-sizing: border-box;color: #6c757d!important;text-decoration: underline;--bs-text-opacity: 1;"><span data-feather="instagram" style="box-sizing: border-box;"></span></a></li>
                    <li class="ms-3" style="box-sizing: border-box;margin-left: 1rem!important;"><a class="text-muted" href="https://github.com/rvalms" style="box-sizing: border-box;color: #6c757d!important;text-decoration: underline;--bs-text-opacity: 1;"><span data-feather="github" target="_blank" style="box-sizing: border-box;"></span></a></li>
                    <li class="ms-3" style="box-sizing: border-box;margin-left: 1rem!important;"><a class="text-muted" href="https://www.linkedin.com/in/riva-almero-5755aa164/" target="_blank" style="box-sizing: border-box;color: #6c757d!important;text-decoration: underline;--bs-text-opacity: 1;"><span data-feather="linkedin" style="box-sizing: border-box;"></span></a></li>
                </ul>
            </div>
        </div>
    </div>


    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous" style="box-sizing: border-box;"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous" style="box-sizing: border-box;"></script>
    <script style="box-sizing: border-box;">feather.replace()</script>
</body>
</html>