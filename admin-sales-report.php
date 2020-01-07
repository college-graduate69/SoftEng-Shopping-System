<?php
    require 'vendor/autoload.php';
    require_once('autoload.php');
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    AdminCheck();
    $spreadsheet = new Spreadsheet();
    $products = new Products ($db);
    $productItems = new Display($db);
    $reports = new Reports($db);

    if(isset($_POST['weekly'])) {
        $today = $_POST['date'];
        $date = date_create($today);
        date_sub($date, date_interval_create_from_date_string("7 days"));
        $products = [];
        foreach($reports->getStocks() as $list) {
           array_push($products,[$list['productName'], $list['productQty']]);
        }
        
        $theString = "SALES FROM THE WEEK OF ". $today;
        $spreadsheet->getActiveSheet()->mergeCells('A1:T1');
        $spreadsheet->getActiveSheet()->setCellValue('A1', $theString);
        $spreadsheet->getActiveSheet()->mergeCells('A2:B2');
        $spreadsheet->getActiveSheet()->setCellValue('A2', 'INVENTORY');
        $spreadsheet->getActiveSheet()->setCellValue('A3', 'Product Name');
        $spreadsheet->getActiveSheet()->setCellValue('B3', 'Quantity');
        $spreadsheet->getActiveSheet()->getStyle('A1')
        ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);
        $spreadsheet->getActiveSheet()->getStyle('A1')
        ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $spreadsheet->getActiveSheet()->getStyle('A1')
        ->getFill()->getStartColor()->setARGB('993300');       
        $spreadsheet->getActiveSheet()->getStyle('A2')
        ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);
        $spreadsheet->getActiveSheet()->getStyle('A2')
        ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $spreadsheet->getActiveSheet()->getStyle('A2')
        ->getFill()->getStartColor()->setARGB('b30000');
        $sheet = $spreadsheet->getActiveSheet()->
            fromArray(
                $products,
                NULL,
                'A4'
            );
        $checkedOut = [];
        foreach($reports->getWeekly(date_format($date, "y-m-d"), $_POST['date']) as $list) {
        
            foreach($list['products'] as $products) {
                array_push($checkedOut, [$products['transactionId'], $list['dates'], $products['productType'], $products['productName'],$products['productQty'], $products['total']]);
            }  
        }
        $spreadsheet->getActiveSheet()->mergeCells('E2:J2');
        $spreadsheet->getActiveSheet()->setCellValue('E2', 'CHECKEDOUT PRODUCTS');
        $spreadsheet->getActiveSheet()->setCellValue('E3', 'Transaction ID');
        $spreadsheet->getActiveSheet()->setCellValue('F3', 'Date Ordered');
        $spreadsheet->getActiveSheet()->setCellValue('G3', 'Product Category');
        $spreadsheet->getActiveSheet()->setCellValue('H3', 'Product Name');
        $spreadsheet->getActiveSheet()->setCellValue('I3', 'Quantity');
        $spreadsheet->getActiveSheet()->setCellValue('J3', 'Total');
        $spreadsheet->getActiveSheet()->getStyle('E2')
        ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);
        $spreadsheet->getActiveSheet()->getStyle('E2')
        ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $spreadsheet->getActiveSheet()->getStyle('E2')
        ->getFill()->getStartColor()->setARGB('b30000');
        $sheet = $spreadsheet->getActiveSheet()->
        fromArray(
            $checkedOut,
            NULL,
            "E4"
        );
        
        $checkedOutSummary = [];
        foreach($reports->getWeeklySummary(date_format($date, "y-m-d"), $_POST['date']) as $list) {
            array_push($checkedOutSummary, [$list['productName'], $list['productQty'], $list['productPrice']]);    
        }
        $spreadsheet->getActiveSheet()->mergeCells('L2:O2');
        $spreadsheet->getActiveSheet()->setCellValue('L2', 'SUMMARY OF CHECKEDOUT PRODUCTS');
        $spreadsheet->getActiveSheet()->setCellValue('L3', 'Product Name');
        $spreadsheet->getActiveSheet()->setCellValue('M3', 'Quantity');
        $spreadsheet->getActiveSheet()->setCellValue('N3', 'Total');
        $spreadsheet->getActiveSheet()->getStyle('L2')
        ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);
        $spreadsheet->getActiveSheet()->getStyle('L2')
        ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $spreadsheet->getActiveSheet()->getStyle('L2')
        ->getFill()->getStartColor()->setARGB('b30000');
        $sheet = $spreadsheet->getActiveSheet()->
        fromArray(
            $checkedOutSummary,
            NULL,
            "L3"
        );
        $categorySummary = [];
        foreach($reports->getWeeklyCategory(date_format($date, "y-m-d"), $_POST['date']) as $list) {
            array_push($categorySummary, [$list['productType'], $list['productQty']]);
        }
        $spreadsheet->getActiveSheet()->mergeCells('Q2:T2');
        $spreadsheet->getActiveSheet()->setCellValue('Q2', 'CATEGORIES SOLD');
        $spreadsheet->getActiveSheet()->setCellValue('Q3', 'Category Name');
        $spreadsheet->getActiveSheet()->setCellValue('R3', 'Quantity');
        $spreadsheet->getActiveSheet()->getStyle('Q2')
        ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);
        $spreadsheet->getActiveSheet()->getStyle('Q2')
        ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $spreadsheet->getActiveSheet()->getStyle('Q2')
        ->getFill()->getStartColor()->setARGB('b30000');
        $sheet = $spreadsheet->getActiveSheet()->
        fromArray(
            $categorySummary,
            NULL,
            "Q4"
        );
        $writer = new Xlsx($spreadsheet);
     
        $writer->save('reports/'.$_POST['date'].' Weekly Report.xlsx');
    }
    if(isset($_POST['monthly'])) {
        $date = $_POST['date'];
        $d = date_parse_from_format("Y-m-d", $date);
        // echo $d["month"];
        // echo $d["year"];
        $monthNum  = $d['month'];
        $dateObj   = DateTime::createFromFormat('!m', $monthNum);
        $monthName = $dateObj->format('F');
        $products = [];
        foreach($reports->getStocks() as $list) {
           array_push($products,[$list['productName'], $list['productQty']]);
        }

        $theString = "SALES ON THE MONTH OF ". $monthName. " ". $d['year'];
        $spreadsheet->getActiveSheet()->mergeCells('A1:T1');
        $spreadsheet->getActiveSheet()->setCellValue('A1', $theString);
        $spreadsheet->getActiveSheet()->setCellValue('A2', 'INVENTORY');
        $spreadsheet->getActiveSheet()->setCellValue('A3', 'Product Name');
        $spreadsheet->getActiveSheet()->setCellValue('B3', 'Quantity');
        $spreadsheet->getActiveSheet()->getStyle('A1')
        ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);
        $spreadsheet->getActiveSheet()->getStyle('A1')
        ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $spreadsheet->getActiveSheet()->getStyle('A1')
        ->getFill()->getStartColor()->setARGB('993300');
        $spreadsheet->getActiveSheet()->getStyle('A2')
        ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);
        $spreadsheet->getActiveSheet()->getStyle('A2')
        ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $spreadsheet->getActiveSheet()->getStyle('A2')
        ->getFill()->getStartColor()->setARGB('b30000');
        $sheet = $spreadsheet->getActiveSheet()->
            fromArray(
                $products,
                NULL,
                'A4'
            );
            $checkedOut = [];
            foreach($reports->getMonthly($d['month'], $d['year']) as $list) {
            
                foreach($list['products'] as $products) {
                    array_push($checkedOut, [$products['transactionId'], $list['dates'], $products['productType'], $products['productName'], $products['productQty'], $products['total']]);
                }  
            }
            $spreadsheet->getActiveSheet()->mergeCells('E2:J2');
            $spreadsheet->getActiveSheet()->setCellValue('E2', 'CHECKEDOUT PRODUCTS');
            $spreadsheet->getActiveSheet()->setCellValue('E3', 'Transaction ID');
            $spreadsheet->getActiveSheet()->setCellValue('F3', 'Date Ordered');
            $spreadsheet->getActiveSheet()->setCellValue('G3', 'Product Category');
            $spreadsheet->getActiveSheet()->setCellValue('H3', 'Product Name');
            $spreadsheet->getActiveSheet()->setCellValue('I3', 'Quantity');
            $spreadsheet->getActiveSheet()->setCellValue('J3', 'Total');
            $spreadsheet->getActiveSheet()->getStyle('E2')
            ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);
            $spreadsheet->getActiveSheet()->getStyle('E2')
            ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
            $spreadsheet->getActiveSheet()->getStyle('E2')
            ->getFill()->getStartColor()->setARGB('b30000');
            $sheet = $spreadsheet->getActiveSheet()->
            fromArray(
                $checkedOut,
                NULL,
                "E4"
            );

        $checkedOutSummary = [];
        foreach($reports->getMonthlySummary($d['month'], $d['year']) as $list) {
            array_push($checkedOutSummary, [$list['productName'], $list['productQty'], $list['productPrice']]);    
        }
        $spreadsheet->getActiveSheet()->mergeCells('L2:O2');
        $spreadsheet->getActiveSheet()->setCellValue('L2', 'SUMMARY OF CHECKEDOUT PRODUCTS');
        $spreadsheet->getActiveSheet()->setCellValue('L3', 'Product Name');
        $spreadsheet->getActiveSheet()->setCellValue('M3', 'Quantity');
        $spreadsheet->getActiveSheet()->setCellValue('N3', 'Total');
        $spreadsheet->getActiveSheet()->getStyle('L2')
        ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);
        $spreadsheet->getActiveSheet()->getStyle('L2')
        ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $spreadsheet->getActiveSheet()->getStyle('L2')
        ->getFill()->getStartColor()->setARGB('b30000');
        $sheet = $spreadsheet->getActiveSheet()->
        fromArray(
            $checkedOutSummary,
            NULL,
            "L4"
        );
        $categorySummary = [];
        foreach($reports->getMonthlyCategory($d['month'], $d['year']) as $list) {
            array_push($categorySummary, [$list['productType'], $list['productQty']]);
        }
        $spreadsheet->getActiveSheet()->mergeCells('Q2:T2');
        $spreadsheet->getActiveSheet()->setCellValue('Q2', 'CATEGORIES SOLD');
        $spreadsheet->getActiveSheet()->setCellValue('Q3', 'Category Name');
        $spreadsheet->getActiveSheet()->setCellValue('R3', 'Quantity');
        $spreadsheet->getActiveSheet()->getStyle('Q2')
        ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);
        $spreadsheet->getActiveSheet()->getStyle('Q2')
        ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $spreadsheet->getActiveSheet()->getStyle('Q2')
        ->getFill()->getStartColor()->setARGB('b30000');
        $sheet = $spreadsheet->getActiveSheet()->
        fromArray(
            $categorySummary,
            NULL,
            "Q4"
        );

        
        $writer = new Xlsx($spreadsheet);
        $writer->save('reports/'. $monthName .' '.$d['year'].' Monthly Report.xlsx');
    }
    if(isset($_POST['yearly'])) {
        $date = $_POST['date'];
        $d = date_parse_from_format("Y-m-d", $date);
        $products = [];
        foreach($reports->getStocks() as $list) {
           array_push($products,[$list['productName'], $list['productQty']]);
        }
        $theString = "SALES FOR THE YEAR OF ". $d['year'];
        $spreadsheet->getActiveSheet()->mergeCells('A1:T1');
        $spreadsheet->getActiveSheet()->setCellValue('A1', $theString);
        $spreadsheet->getActiveSheet()->setCellValue('A2', 'INVENTORY');
        $spreadsheet->getActiveSheet()->setCellValue('A3', 'Product Name');
        $spreadsheet->getActiveSheet()->setCellValue('B3', 'Quantity');
        $spreadsheet->getActiveSheet()->getStyle('A1')
        ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);
        $spreadsheet->getActiveSheet()->getStyle('A1')
        ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $spreadsheet->getActiveSheet()->getStyle('A1')
        ->getFill()->getStartColor()->setARGB('993300');
        $spreadsheet->getActiveSheet()->getStyle('A2')
        ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);
        $spreadsheet->getActiveSheet()->getStyle('A2')
        ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $spreadsheet->getActiveSheet()->getStyle('A2')
        ->getFill()->getStartColor()->setARGB('b30000');
        $sheet = $spreadsheet->getActiveSheet()->
            fromArray(
                $products,
                NULL,
                'A4'
            );
        $checkedOut = [];
        foreach($reports->getYearly($d['year']) as $list) {
            foreach($list['products'] as $products) {
                array_push($checkedOut,[$products['transactionId'], $list['dates'], $products['productType'], $products['productName'], $products['productQty'], $products['total']]);
            }
        }

        $spreadsheet->getActiveSheet()->mergeCells('E2:J2');
        $spreadsheet->getActiveSheet()->setCellValue('E2', 'CHECKEDOUT PRODUCTS');
        $spreadsheet->getActiveSheet()->setCellValue('E3', 'Transaction ID');
        $spreadsheet->getActiveSheet()->setCellValue('F3', 'Date Ordered');
        $spreadsheet->getActiveSheet()->setCellValue('G3', 'Product Category');
        $spreadsheet->getActiveSheet()->setCellValue('H3', 'Product Name');
        $spreadsheet->getActiveSheet()->setCellValue('I3', 'Quantity');
        $spreadsheet->getActiveSheet()->setCellValue('J3', 'Total');
        $spreadsheet->getActiveSheet()->getStyle('E2')
            ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);
        $spreadsheet->getActiveSheet()->getStyle('E2')
            ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $spreadsheet->getActiveSheet()->getStyle('E2')
            ->getFill()->getStartColor()->setARGB('b30000');
        $sheet = $spreadsheet->getActiveSheet()->
        fromArray(
            $checkedOut,
            NULL,
            "E4"
        );
               
        $checkedOutSummary = [];
        foreach($reports->getYearlySummary($d['year']) as $list) {
            array_push($checkedOutSummary, [$list['productName'],  $list['productQty'], $list['productPrice']]);    
        }
        $spreadsheet->getActiveSheet()->mergeCells('L2:O2');
        $spreadsheet->getActiveSheet()->setCellValue('L2', 'SUMMARY OF CHECKEDOUT PRODUCTS');
        $spreadsheet->getActiveSheet()->setCellValue('L3', 'Product Name');
        $spreadsheet->getActiveSheet()->setCellValue('M3', 'Quantity');
        $spreadsheet->getActiveSheet()->setCellValue('N3', 'Total');
        $spreadsheet->getActiveSheet()->getStyle('L2')
        ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);
        $spreadsheet->getActiveSheet()->getStyle('L2')
        ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $spreadsheet->getActiveSheet()->getStyle('L2')
        ->getFill()->getStartColor()->setARGB('b30000');
        $sheet = $spreadsheet->getActiveSheet()->
        fromArray(
            $checkedOutSummary,
            NULL,
            "L4"
        );
        $categorySummary = [];
        foreach($reports->getYearlyCategory($d['year']) as $list) {
            array_push($categorySummary, [$list['productType'], $list['productQty']]);
        }
        $spreadsheet->getActiveSheet()->mergeCells('Q2:T2');
        $spreadsheet->getActiveSheet()->setCellValue('Q2', 'CATEGORIES SOLD');
        $spreadsheet->getActiveSheet()->setCellValue('Q3', 'Category Name');
        $spreadsheet->getActiveSheet()->setCellValue('R3', 'Quantity');
        $spreadsheet->getActiveSheet()->getStyle('Q2')
        ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);
        $spreadsheet->getActiveSheet()->getStyle('Q2')
        ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $spreadsheet->getActiveSheet()->getStyle('Q2')
        ->getFill()->getStartColor()->setARGB('b30000');
        $sheet = $spreadsheet->getActiveSheet()->
        fromArray(
            $categorySummary,
            NULL,
            "Q4"
        );
        $writer = new Xlsx($spreadsheet);
        $writer->save('reports/'. $d['year'] .' Yearly Report.xlsx');
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>:: Shoppping ::</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" media="screen" href="css/admin.css" />
    </head>
    <body>
        <div class="verticalnav">
            <div class="adminlogo">
                <a href = "admin.php" class = "adminlogo">#</a>
            </div>
            <ul class="navlist">
                <li><a href="admin-products.php" class="adminlinks">Products</a></li>
                <li><a href="admin-transaction.php" class="adminlinks">Orders</a></li>
                <li><a href="admin-sales-report.php" class="adminlinks">Sales Reports</a></li>
                <?php if(isset($_SESSION['signeduser'])):?>
                <li><a class="adminlinks" href="index.php?logout=1">LOGOUT</a></li>
                <?php endif; ?>
            </ul>
        </div>
        <!-- navbar ends here -->
        <div class="prodheader">
            <div class="headtxt">
                Produce Sales Report
            </div>
        </div>
        <div class="choicecontainer">
            <form action="admin-sales-report.php" method = "post">
            <div class="salesdateinput">
            <span class="datelabel">Select Date:</span>
            <input type="date" class="dateinput" name="date">
            </div>
            <div class="reportcat">
                <input type="submit" class="forminput weekly" name="weekly" value="Weekly Report">
                <input type="submit" class="forminput monthly" name="monthly" value="Monthly Report">
                <input type="submit" class="forminput yearly" name="yearly" value="Yearly Report">
            </div> 
            </form>
            </div>
        <div class="choicecontainer">
                <a href="reports/" class="reportlink">&#xab; View Reports</a>
        </div>
    </body>
</html>