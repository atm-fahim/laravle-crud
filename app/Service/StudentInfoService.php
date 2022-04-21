<?php

namespace App\Service;

interface StudentInfoService
{

    public function save($data);
    public function getTotalSuccessTransactions($date);
    public function getTransactionDetailsById($id);
    public function getTransactionByInvoice($data);

}
