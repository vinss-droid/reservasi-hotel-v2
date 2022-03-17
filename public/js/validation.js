$(document).ready(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#pesan').click(function (e) {
        e.preventDefault();

        const checkin = $('#checkIn').val();
        const checkout = $('#checkOut').val();
        const jKamar = $('#jKamar').val();

        if (checkin && checkout && jKamar != '') {
            $('#checkIn').removeClass('is-invalid');
            $('#checkOut').removeClass('is-invalid');
            $('#jKamar').removeClass('is-invalid');
            $('#Fpesan').removeClass('d-none');
            $('#pPesan').addClass('d-none');
        } else {
            if (checkin == '' && checkout == '' && jKamar == '') {
                $('#checkIn').addClass('is-invalid');
                $('#checkOut').addClass('is-invalid');
                $('#jKamar').addClass('is-invalid');
            } else if (checkin == '' && checkout == '') {
                $('#checkIn').addClass('is-invalid');
                $('#checkOut').addClass('is-invalid');
                $('#jKamar').removeClass('is-invalid');
            } else if (checkin == '' && jKamar == '') {
                $('#checkIn').addClass('is-invalid');
                $('#jKamar').addClass('is-invalid');
                $('#checkOut').removeClass('is-invalid');
            } else if (checkout == '' && jKamar == '') {
                $('#checkOut').addClass('is-invalid');
                $('#jKamar').addClass('is-invalid');
                $('#checkIn').removeClass('is-invalid');
            } else if (checkin == '') {
                $('#checkIn').addClass('is-invalid');
                $('#checkOut').removeClass('is-invalid');
                $('#jKamar').removeClass('is-invalid');
            } else if (checkout == '') {
                $('#checkOut').addClass('is-invalid');
                $('#checkIn').removeClass('is-invalid');
                $('#jKamar').removeClass('is-invalid');
            } else if (jKamar == '') {
                $('#jKamar').addClass('is-invalid');
                $('#checkIn').removeClass('is-invalid');
                $('#checkOut').removeClass('is-invalid');
            }
        }

    });

    $('body').on('click', '#Kpesan', function (e) {
        e.preventDefault();
        const id = $('#Fkamar option:selected').val();
        // console.log(id)
        const checkin = $('#checkIn').val();
        const checkout = $('#checkOut').val();
        const jKamar = $('#jKamar').val();
        const tamu = $('#Ftamu').val();
        const tipeKamar = $('select[name="Ftipe"]').val();

        if (tipeKamar == '') {
            $('#Fkamar').addClass('is-invalid');
            $('#checkOut').removeClass('is-invalid');
            $('#checkIn').removeClass('is-invalid');
            $('#jKamar').removeClass('is-invalid');
            $('#Ftamu').removeClass('is-invalid');
        } else {
            $.get('/cek-jumlah-kamar/' + id, function (data) {
                if (jKamar > data.data) {
                    if (data.data == 0) {
                        $('#VCjumlah').text('Persediaan Kamar Sudah Penuh');
                        $('#jKamar').addClass('is-invalid');
                    } else {
                        $('#VCjumlah').text('Jumlah kamar tidak boleh lebih dari ' + data.data);
                        $('#jKamar').addClass('is-invalid');
                    }
                } else {
                    if (checkin && checkout && jKamar && tamu && tipeKamar != '') {

                        if (jKamar > data.data) {
                            if (data.data == 0) {
                                $('#VCjumlah').text('Persediaan Kamar Sudah Penuh');
                                $('#jKamar').addClass('is-invalid');
                            } else {
                                $('#VCjumlah').text('Jumlah kamar tidak boleh lebih dari ' + data.data);
                                $('#jKamar').addClass('is-invalid');
                            }
                        } else {
                            $('#checkIn').removeClass('is-invalid');
                            $('#checkOut').removeClass('is-invalid');
                            $('#jKamar').removeClass('is-invalid');
                            $('#Ftamu').removeClass('is-invalid');
                            $('Fkamar').removeClass('is-invalid');
                            $('#Cpesan').modal('show');

                            const checkin = $('#checkIn').val();
                            const checkout = $('#checkOut').val();
                            const tipeKamar = $('select[name="Ftipe"]').val();
                            const tipeKamarText = $('#Fkamar option:selected').text();
                            const jKamar = $('#jKamar').val();
                            const tamu = $('#Ftamu').val();

                            $('#MtglCheckIn').val(checkin);
                            $('#MtglCheckOut').val(checkout);
                            $('#RMkamar').val(tipeKamar);
                            $('#Mkamar').val(tipeKamarText);
                            $('#Mjumlah').val(jKamar);
                            $('#Mtamu').val(tamu);
                        }

                    } else {
                        if (checkin == '' && checkout == '' && jKamar == '' && tamu == '') {
                            $('#VCjumlah').text('Jumlah Kamar Wajib di Isi !');
                            $('#checkIn').addClass('is-invalid');
                            $('#checkOut').addClass('is-invalid');
                            $('#jKamar').addClass('is-invalid');
                            $('#Ftamu').addClass('is-invalid');
                            $('#Fkamar').addClass('is-invalid');
                        } else if (checkin == '' && checkout == '' && jKamar == '' && tamu == '') {
                            $('#VCjumlah').text('Jumlah Kamar Wajib di Isi !');
                            $('#checkIn').addClass('is-invalid');
                            $('#checkOut').addClass('is-invalid');
                            $('#jKamar').addClass('is-invalid');
                            $('#Ftamu').addClass('is-invalid');
                            $('#Fkamar').removeClass('is-invalid');
                        } else if (checkin == '' && jKamar == '' && jKamar == '' && tamu == '') {
                            $('#VCjumlah').text('Jumlah Kamar Wajib di Isi !');
                            $('#checkIn').addClass('is-invalid');
                            $('#jKamar').addClass('is-invalid');
                            $('#Ftamu').addClass('is-invalid');
                            $('#Fkamar').addClass('is-invalid');
                            $('#checkOut').removeClass('is-invalid');
                        } else if (checkout == '' && jKamar == '' && jKamar == '' && tamu == '') {
                            $('#VCjumlah').text('Jumlah Kamar Wajib di Isi !');
                            $('#checkOut').addClass('is-invalid');
                            $('#jKamar').addClass('is-invalid');
                            $('#Ftamu').addClass('is-invalid');
                            $('#Fkamar').addClass('is-invalid');
                            $('#checkIn').removeClass('is-invalid');
                        } else if (checkin == '') {
                            $('#checkIn').addClass('is-invalid');
                            $('#checkOut').removeClass('is-invalid');
                            $('#jKamar').removeClass('is-invalid');
                        } else if (checkout == '') {
                            $('#checkOut').addClass('is-invalid');
                            $('#checkIn').removeClass('is-invalid');
                            $('#jKamar').removeClass('is-invalid');
                        } else if (jKamar == '') {
                            $('#VCjumlah').text('Jumlah Kamar Wajib di Isi !');
                            $('#jKamar').addClass('is-invalid');
                            $('#checkIn').removeClass('is-invalid');
                            $('#checkOut').removeClass('is-invalid');
                        } else if (tamu == '') {
                            $('#Ftamu').addClass('is-invalid');
                            $('#checkOut').removeClass('is-invalid');
                            $('#checkIn').removeClass('is-invalid');
                            $('#jKamar').removeClass('is-invalid');
                            $('#Fkamar').removeClass('is-invalid');
                        } else if (tipeKamar == '') {
                            $('#Fkamar').addClass('is-invalid');
                            $('#checkOut').removeClass('is-invalid');
                            $('#checkIn').removeClass('is-invalid');
                            $('#jKamar').removeClass('is-invalid');
                            $('#Ftamu').removeClass('is-invalid');
                        }
                    }
                }
            });
        }

    });

    $('#Mpesan').click(function (e) {


        const checkin = $('#checkIn').val();
        const checkout = $('#checkOut').val();
        const tipeKamar = $('select[name="Ftipe"]').val();
        const tipeKamarText = $('#Fkamar option:selected').text();
        const jKamar = $('#jKamar').val();
        const tamu = $('#Ftamu').val();
        const email = $('#email').val();
        let _token = $('input[name="_token"]').val();

        console.log(_token);

        $.ajax({
            type: "POST",
            url: "/save-reservasi",
            data: {
                email: email,
                checkin: checkin,
                checkout: checkout,
                kamar: tipeKamar,
                tamu: tamu,
                jumlah: jKamar,
                _token: _token,
            },
            // dataType: "dataType",
            success: function (response) {
                console.log(response);
                window.location.href = 'https://hotel-hebat-v2.vinss/riwayat-pesanan';
            }
        });
    });

});