@extends('frontend.layouts.master')

@section('title', 'Chaixi Corporation')
@section('css')
<style>
    /* Base styles (ค่าเริ่มต้นสำหรับทุกขนาดหน้าจอ) */
    p {
        color: black;
    }

    #header_mobile {
        height: 10px;
    }

    #chili_mobile {
        height: 150px;
    }

    /* Extra Small Devices (น้อยกว่า 400px) */
    @media screen and (max-width: 399px) {

        #header_mobile {
            height: 138px;
        }

        #pork_mobile {
            height: 35px;
        }

        #chili_mobile {
            height: 101px;
        }

        #sauce_mobile {
            height: 40px;
        }

        #input_total {
            width: 10px;
        }

    }

    /* Small Mobile (400px - 475px) */
    @media screen and (min-width: 400px) and (max-width: 475px) {

        #header_mobile {
            height: 138px;
        }

        #pork_mobile {
            height: 24px;
        }

        #chili_mobile {
            height: 100px;
        }

        #sauce_mobile {
            height: 40px;
        }
    }

    /* Mobile (476px - 575px) */
    @media screen and (min-width: 476px) and (max-width: 575px) {

        #header_mobile {
            height: 140px;
        }

        #pork_mobile {
            height: 58px;
        }

        #chili_mobile {
            height: 120px;
        }

        #sauce_mobile {
            height: 60px;
        }
    }

    /* Small Devices/Tablets (576px - 767px) */
    @media screen and (min-width: 576px) and (max-width: 767px) {

        #header_mobile {
            height: 160px;
        }

        #pork_mobile {
            height: 65px;
        }

        #chili_mobile {
            height: 138px;
        }

        #sauce_mobile {
            height: 64px;
        }
    }

    /* Medium Devices/Tablets (768px - 991px) */
    @media screen and (min-width: 768px) and (max-width: 991px) {

        #header_mobile {
            height: 90px;
        }

        #chili_mobile {
            height: 111px;
        }
    }

    /* Desktop (992px - 1199px) */
    @media screen and (min-width: 992px) and (max-width: 1199px) {

        #header_mobile {
            height: 65px;
        }

        #chili_mobile {
            height: 63px;
        }
    }

    /* Large Desktop (1200px ขึ้นไป) */
    @media screen and (min-width: 1200px) {

        #header_mobile {
            height: 65px;
        }

        #chili_mobile {
            height: 63px;
        }
    }

    .date-alert-container {
        display: flex;
        align-items: center;
    }

    .alert-text {
        color: red;
        margin-right: 5px;
        display: none;
    }

    .date-text {
        margin: 0;
    }

    .text-status-prop {
        word-wrap: break-word;
        /* ทำให้ข้อความขึ้นบรรทัดใหม่เมื่อเกินขอบ */
        overflow-wrap: break-word;
    }

    @media (max-width: 767px) {
        .fp__testimonial_page_1 {
            margin-top: 80px !important;
        }
    }

    @media screen and (max-width: 600px) {
        table {
            font-size: 14px;
        }

        th,
        td {
            padding: 5px;
        }

        .ingredient-name {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .percentage {
            display: block;
            font-size: 12px;
            color: #666;
        }

        .header {
            height: 60px;
        }
    }

    table {
        /* border-collapse: collapse; */

        /* margin: 20px auto; */
    }

    #tableOne {
        /* border-collapse: collapse;
        margin: 20px auto; */
        width: 100%;
        max-width: 800px;
    }

    th,
    td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: center;
        width: 100px;
    }

    th {
        background-color: #f2f2f2;
    }

    .badge {
        width: 100%;
        display: flex;
        align-items: center;
        white-space: normal;
        text-align: center;
        padding: 8px;
    }

    .badge p {
        margin: 0;
        padding-left: 5px;
    }

    #tableTwo td {
        background-color: #FFF5CD;
        padding: 8px;
        text-align: center;
        width: 10px !important;
    }

    #tableTwo td:first-child {
        background-color: #FFC000;
        font-weight: normal;
    }

    #tableTwo input[type="number"] {
        width: 80px;
        margin: 0 auto;
        text-align: center;
    }
</style>
@endsection

@section('content')
<section class="bg">
    <!-- ส่วนของ Banner -->
    <section class="fp__testimonial_page_1" style="margin-top:130px;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <img src="{{ asset('frontend/images/banner_1.png') }}">
                </div>
            </div>
        </div>
    </section>
    <section class="fp__testimonial_page">
        <div class="container d-flex justify-content-center align-items-center ">
            <div class="col-xl-12 col-md-12 col-lg-12 col-md-12 col-12" data-wow-duration="1s">
                <div class="row">
                    <div class="col-xl-12">
                        <img style="width:1500px important;" src="{{ asset('frontend/images/banner_2.png') }}">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="fp__testimonial_page">
        <div class="container d-flex justify-content-center align-items-center min-vh-75">
            <div class="col-xl-12 col-md-12 col-lg-12 col-md-12 col-12" data-wow-duration="1s">
                <div class="fp__single_testimonial">
                    <div class="fp__testimonial_header">
                        <div class="row">
                            <div class="col-md-12">
                                <form id="searchForm" class="row align-items-center">
                                    @csrf
                                    <div class="col-md-3">
                                        <label for="car_license" class="col-form-label">เลขทะเบียนรถเข็น</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="car_license" id="car_license" class="form-control">
                                    </div>
                                    <div class="col-md-3">
                                        <button class="btn btn-primary btn-search" type="submit">ตรวจสอบ</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- เพิ่มส่วนแสดงผลลัพธ์การค้นหา -->
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <div id="searchResult"></div>
                            </div>
                        </div>
                    </div>
                    <div class="fp__testimonial_header mt-5">
                        <div class="row">
                            <div class="col">
                                <h1><strong class="text-danger" id="status_prop"
                                        style="display: none">สถานะรถเข็นติดดาว</strong></h1>
                            </div>
                            <div class="col ">
                                <span id="text-received" style="font-size: 30px;" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                            </div>
                            <div class="col">
                                <span id="text-purchase" style="font-size: 30px;" class="text-danger"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ตาราง -->
                <div class="card mt-2" id="tableContainer" style="display: none;">
                    <div class="card-header text-end">
                        <p>ตารางตัวอย่างจำนวนการซื้อสินค้าขั้นต่ำ ที่สมส่วน</p>
                    </div>
                    <div class="card-body">
                        <div class="fp__testimonial_header">
                            <div class="row g-1">
                                <div class="col-8 table-container">
                                    <div class="table-responsive">
                                        <table class="table table-responsive-stack table-hover" id="tableOne">
                                            <thead>
                                                <tr>
                                                    <th style="font-weight: normal; background-color: #FFC000;">ลำดับ
                                                    </th>
                                                    <th style="font-weight: normal; background-color: #FFC000;">รายการ
                                                    </th>
                                                    <th style="font-weight: normal; background-color: #FFC000;">เป้า
                                                    </th>
                                                    <th style="font-weight: normal; background-color: #FFC000;">
                                                        ซื้อเพิ่มเพื่อให้ได้เป้า</th>
                                                    <th style="background-color: #FFC000;">ยอดซื้อปัจจุบัน</th>
                                                    <th style="background-color: #FFC000;">แนะนำซื้อเพิ่ม</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- ข้อมูลจะถูกเพิ่มด้วย JavaScript -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- แก้ไขส่วนตารางคำนวณในโค้ดเดิม -->
                                <div class="col-4 table-container">
                                    <div class="table-responsive">
                                        <table class="table table-responsive-stack table-hover" id="tableTwo">
                                            <tbody>
                                                <tr>
                                                    <td id="header_mobile" style=" background-color: #FFC000;">
                                                        สัดส่วนการซื้อ</td>
                                                    <td id="input_total"
                                                        style="font-weight: normal; background-color: #FFC000;">จำนวน
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>55.0%</td>
                                                    <td>
                                                        <input type="number" style="height: 25px;" id="noodles" min="0"
                                                            step="1" class="form-control text-center">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>8.0%</td>
                                                    <td id="soup">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td id="pork_mobile">7.0%</td>
                                                    <td id="pork">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>14.0%</td>
                                                    <td id="leng">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>4.5%</td>
                                                    <td id="groundPork">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td id="chili_mobile">9.0%</td>
                                                    <td id="chili">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td id="sauce_mobile">2.5%</td>
                                                    <td id="sauce">
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-header-action">
                                    <span id="currentDate" class="badge badge-primary d-inline-flex align-items-center">
                                        <span>ข้อมูลวันที่:</span> &nbsp;&nbsp;
                                        <span class="text-danger ml-1">{{ $formattedDate }}</span>
                                        {{-- <span class="text-danger ml-1 text-status-prop">อยู่ระหว่างการดำเนินการ
                                            ข้อมูลจะอัปเดตอีกครั้งวันที่ 04/11/2567</span> --}}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Banner --}}
    <section class="fp__testimonial_page ">
        <div class="container d-flex justify-content-center align-items-center ">
            <div class="col-xl-12 col-md-12 col-lg-12 col-md-12 col-12" data-wow-duration="1s">
                <div class="row">
                    <div class="col-md-12">
                        <img src="{{ asset('frontend/images/footer_banner.png') }}">
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#searchForm').on('submit', function(e) {
            e.preventDefault();
            searchLicense();
        });

        // ค้นหาทะเบียนรถเข็น
        function searchLicense() {
            let car_license = $('#car_license').val();
            if (car_license.trim() === "") {
                $('#searchResult').html('<p class="text-danger">กรุณากรอกเลขทะเบียน!</p>');
                return;
            }
            $.ajax({
                type: "PUT",
                url: "{{ route('search_car_license') }}",
                data: {
                    car_license: car_license,
                    _token: $('input[name="_token"]').val()
                },
                dataType: "JSON",
                success: function(response) {
                    if (response.status === 'success') {
                        showTable();
                        showStatus();
                        displayResult(response.data);
                        $('#searchResult').html('<p class="text-success">พบข้อมูลทะเบียนรถ: ' + car_license + '</p>');
                    } else {
                        $('#searchResult').html('<p class="text-danger">ไม่พบข้อมูลทะเบียนรถ: ' + car_license + '</p>');
                        reload();
                    }
                },
                error: function() {
                    $('#searchResult').html('<p class="text-danger">เกิดข้อผิดพลาดในการค้นหา</p>');
                    Swal.fire({
                        title: "เกิดข้อผิดพลาด",
                        text: "เกิดข้อผิดพลาดในการค้นหา กรุณาลองใหม่อีกครั้ง",
                        icon: "error"
                    });
                }
            });
        }
        function reload() {
    // ซ่อนตาราง
    $('#tableContainer').hide();
    // ซ่อนสถานะรถเข็น
    $('#status_prop').hide();
    // ล้างข้อความสถานะ
    $('#text-received').text('');
    $('#text-purchase').text('');
    // ล้างข้อมูลในตาราง
    $('#tableOne tbody').empty();
}
        // Validate input
        document.getElementById('noodles').addEventListener('input', function(e) {
            this.value = this.value.replace(/[^0-9]/g, '');
        });

        // document.getElementById('car_license').addEventListener('input', function(e) {
        //     this.value = this.value.replace(/[^0-9]/g, '');
        // });

        // แสดงข้อมูล
        function showTable() {
            document.getElementById('tableContainer').style.display = 'block';
        }
        // แสดงสถานะรถเข็น
        function showStatus() {
            document.getElementById('status_prop').style.display = 'block';
        }

        function displayResult(data) {
            if (data && data.length > 0) {
                $('#div-hidden', '#tbl_result').hide();
                $('#tableOne tbody').html(generateTableRows(data));

                // show
                $('#alert').css('display', 'block');

                // คำนวณวันที่ย้อนหลัง 1 วัน
                let dateParts = '8/10/2567'.split('/');
                let currentDate = new Date(parseInt(dateParts[2]) - 543, parseInt(dateParts[1]) - 1, parseInt(dateParts[0]));
                currentDate.setDate(currentDate.getDate() - 1);

                let day = currentDate.getDate().toString().padStart(2, '0');
                let month = (currentDate.getMonth() + 1).toString().padStart(2, '0');
                let year = currentDate.getFullYear() + 543;
                let newDateString = `${day}/${month}/${year}`;
                //console.log(newDateString);
                // $('#currentDate').text('ข้อมูลวันที่: ' + $Create_Date);

                $('#text-received').text(data[0].StatusDes || '');
                $('#text-purchase').text(data[0].Remark || '');

                $('table.table-responsive-stack').each(function (i) {
                    var id = $(this).attr('id');
                    responsiveTable(id);
                });
            } else {
                $('#tableOne tbody').html('<tr><td colspan="6">ไม่พบข้อมูล</td></tr>');
                $('#text-received').text('');
                $('#text-purchase').text('');
            }
        }

        // ฟังก์ชันสำหรับทำให้ตาราง responsive
        function responsiveTable(table) {
            $('#' + table + ' td').each(function (i) {
                var th = $('#' + table + ' th').eq($(this).index());
                $(this).attr('data-label', th.text());
            });
        }

        // table result ajax
        function generateTableRows(data) {
            return data.map((item, index) => `
                <tr>
                    <td data-label="ลำดับ">${index + 1}</td>
                    <td data-label="รายการ">${item.ProductName}</td>
                    <td data-label="ยอดซื้อเดือนที่แล้ว">${item.Target}</td>
                    <td data-label="ซื้อเพิ่ม">${item.Add}</td>
                    <td data-label="ปัจจุบัน" style="background-color: #FFF5CD;"><strong>${item.CurrentMonth}</strong></td>
                    <td data-label="แนะนำซื้อเพิ่ม" style="background-color: #FFF5CD;"><strong>${item.Recommend}</strong></td>
                </tr>
            `).join('');
        }
    });

    // ปัดเศษขึ้น
    function roundUp(num) {
        return Math.ceil(num);
    }

    function calculateIngredients(noodles) {
        const percentages = {
            noodles: 55.0,
            soup: 8.0,
            pork: 7.0,
            leng: 14.0,
            groundPork: 4.5,
            chili: 9.0,
            sauce: 2.5
        };

        const base = Math.round(noodles / (percentages.noodles / 100));
        return {
            noodles: noodles,
            soup: Math.round(base * (percentages.soup / 100)),
            pork: Math.round(base * (percentages.pork / 100)),
            leng: Math.round(base * (percentages.leng / 100)),
            groundPork: Math.round(base * (percentages.groundPork / 100)),
            chili: Math.round(base * (percentages.chili / 100)),
            sauce: Math.round(base * (percentages.sauce / 100))
        };
    }

    document.getElementById('noodles').addEventListener('input', function() {
        const noodles = parseInt(this.value) || 0;
        const result = calculateIngredients(noodles);
        document.getElementById('soup').textContent = result.soup;
        document.getElementById('pork').textContent = result.pork;
        document.getElementById('leng').textContent = result.leng;
        document.getElementById('groundPork').textContent = result.groundPork;
        document.getElementById('chili').textContent = result.chili;
        document.getElementById('sauce').textContent = result.sauce;
    });
</script>
@endpush
