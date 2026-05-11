<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Chalan</title>
    <style>
        body {
            font-family: Arial;
            font-size: 10px;
            margin: 0px;
            padding: 0px;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .dn {
            display: none;
        }

        table tr th, table tr td {
            border: 1px solid #000;
            padding: 5px;
            font-size: 10pt;
        }
    </style>
</head>

<body style="font-family: Arial;">
    <div style="text-align: right; padding: 5px 0; width: 90%; margin: 0 auto;">
        <button type="button" class="btn btn-default btn-primary" data-print="modal" onclick="PrintDoc()">Print</button>
    </div>
    <div id="prodiv">
        <div id="content" style="position:relative; width:800px; margin:0 auto">
            <table border="1" cellspacing="0" cellpadding="8" width="100%" style="border-collapse:collapse;">
                <thead>
                    <tr>
                        <th colspan="2">
                            <div style="padding: 0 15px 3px;">
                                <div style="text-align: center; font-size: 20pt; margin: 0px 0px 0px 0px; padding: 0px 0 0; color: #383838; font-weight: bold;">
                                    CHALLAN
                                </div>
                                <div style="text-align: center; margin:0px 0px 0px 0px; font-size:14pt; padding: 0px; color:#383838; font-weight: bold;">
                                    (खेल विभाग)
                                </div>
                                <div style="text-align: center; margin:0px 0px 0px 0px; font-size:16pt; padding: 0px; color:#383838; font-weight: bold;">
                                    Government of Uttar Pradesh
                                </div>
                                <div style="text-align: center; margin:0px 0px 0px 0px; font-size:13pt; padding: 0px; color:#383838; font-weight: bold;">
                                    Uttar PradeshTreasury Form-209(1) - Challan for Depositing Money
                                </div>
                                <div style="text-align: center; margin:0px 0px 0px 0px; font-size:13pt; padding: 0px; color:#383838; font-weight: bold;">
                                    [To be submitted through Net-Payment]
                                </div>
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            Challan No.: <strong>BHV240000695</strong>
                        </td>
                        <td>
                            Challan Date:<strong>15/02/2024</strong>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Assessment Year:<strong>2023-2024</strong>
                        </td>
                        <td>
                            Tax Period: <strong>ANNUAL</strong>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Name of the Bank
                        </td>
                        <td>
                            <strong><em>State Bank    of India</em></strong>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Unique ID
                        </td>
                        <td>
                            <strong> </strong>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Depositor Name
                        </td>
                        <td>
                            <strong>SHIV BHARGAVA</strong>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Depositor Address
                        </td>
                        <td>
                            <strong>Nil</strong>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div class="table-responsive" style="padding:1rem;">
                                <table class="table" border="0" cellspacing="0" cellpadding="3" width="100%" style="border-collapse:collapse; font-size:10pt;">
                                    <thead>
                                        <tr>
                                            <th>Head</th>
                                            <th>Description</th>
                                            <th>Serial No.</th>
                                            <th>Amount (in Rs.)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>823500200040000</td>
                                            <td>खेल विभाग</td>
                                            <td align="center">1</td>
                                            <td align="right">37500.00</td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>Totals of the above heads</td>
                                            <td>-</td>
                                            <td align="right">37500.00</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align:center;">
                            A SUM OF Rs. 37500.00 AGAINST THE HEADS MENTIONED ABOVE --[ THROUGH    NET-PAYMENT TRANSACTION ]-- ON <strong><em>State    Bank of India </em></strong>HAS BEEN DEPOSITED BY    THE DEPOSITOR.<br />
                            (Depositor Remarks->None)<br />
                            THE BANK REFERENCE NO. RECEIVED AFTER    THE TRANSACTION IS : CPADNHSLI8, Scroll Date:-15/02/2024
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function PrintDoc() {
            var toPrint = document.getElementById('prodiv');

            var popupWin = window.open('', '_blank', 'left=100,top=100,width=1100,height=600,tollbar=0,scrollbars=1,status=0,resizable=1');

            popupWin.document.open();

            popupWin.document.write('<html><title>Readiness_Report</title><head><style>body{font-family:Arial; counter-reset: page;} .noprint{display: none;} table{width:100%; border-collapse:collapse;} .table tr th, .table tr td{border:1px solid #000; padding:3px 3px; font-size: 10pt;} @page { size: A4 portrait; margin: 10pt 10pt 10pt;}</style></head><body onload="window.print()">')

            popupWin.document.write(toPrint.innerHTML);

            popupWin.document.write('</body></html>');

            popupWin.document.close();
        }
    </script>
</body>
</html>
