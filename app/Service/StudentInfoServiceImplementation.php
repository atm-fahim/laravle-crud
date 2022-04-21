<?php

namespace App\Modules\Service;
use App\Repository\StudentInfoInterface;
use App\Service\StudentInfoService;


class StudentInfoServiceImplementation implements StudentInfoService
{

    protected $studentInfo;

    /**
     * @param StudentInterface $studentInfo
     */
    public function __construct(StudentInfoInterface $studentInfo)
    {
        $this->studentinfo = $studentInfo;
    }

    public function save($data)
    {

        $data = [
            'name' => $request['name'],
            'email' => $request['email'],
            'mobile' => $request['mobile'],
            'password' =>bcrypt($request['password'])
        ];
        return $this->studentinfo->save($data);
    }

    private function getWhereBetween($data)
    {
        $whereBetween = [];
        if (isset($data['startDate']) && !empty($data['startDate'])) {
            $whereBetween['last_three_month_data.startDate'] = $data['startDate'] . ' 00:00:00';
        }
        if (isset($data['endDate']) && !empty($data['endDate'])) {
            $whereBetween['last_three_month_data.endDate'] = $data['endDate'] . ' 23:59:59';
        }

        return $whereBetween;
    }

    public function getSearchData($data)
    {

        $whereBetween = $this->getWhereBetween($data);
        $conditions = $this->getCondtionsParams($data);
        $paginate = 20;
        return $this->transaction->getTransactions($conditions, $whereBetween, $paginate);
    }

    public function exportTransactionBySearch($data)
    {

        $params = [];
        parse_str($data, $params);
        $conditions = [];
        $whereBetween = [];
        if (isset($params['merchant_id']) && !empty($params['merchant_id'])) {
            $conditions[] = ['last_three_month_data.merchant_id', $params['merchant_id']];
        }
        if (isset($params['stor_id']) && !empty($params['stor_id'])) {
            $conditions[] = ['last_three_month_data.store_id', $params['stor_id']];
        }
        if (isset($params['pay_status']) && !empty($params['pay_status'])) {
            $conditions[] = ['last_three_month_data.sp_code', $params['pay_status']];
        }
        if ((isset($params['opt_select']) && !empty($params['opt_select'])) && isset($params['trx_invoice_no']) && !empty($params['trx_invoice_no'])) {
            $conditions[] = ['last_three_month_data'. "." .$params["opt_select"], $params['trx_invoice_no']];
        }


        if (isset($params['startDate']) && !empty($params['startDate'])) {
            $whereBetween['startDate'] = $params['startDate'] . ' 00:00:00';
        }
        if (isset($params['endDate']) && !empty($params['endDate'])) {
            $whereBetween['endDate'] = $params['endDate'] . ' 23:59:59';
        }

        $transactions = $this->transaction->getExportTransactions($conditions, $whereBetween);
        $results['transactions'] = $transactions;
        $results['params'] = $params;

        return $results;

    }

    public function getTotalSuccessTransactions($data)
    {

        $conditions[] = ['sp_code', '=', 'Success'];
        $whereBetween = [];
        if ((isset($data['startDate']) && !empty($data['startDate'])) && (isset($data['endDate']) && !empty($data['endDate']))) {
            $whereBetween = $this->getWhereBetween($data);
        }

        $conditions = $this->getCondtionsParams($data);

        return $this->transaction->countTotalSuccessTransactions($whereBetween, $conditions);
    }

    public function getTransactionDetailsById($id)
    {

        $data = $this->transaction->getTransactionDetailsById($id);
        $transaction['transaction'] = $data;
        $transaction['logo'] = isset($data->store_logo) ? $data->store_logo : 'uploads/store_logo/1628174107.png';
        return $transaction;


    }

    public function getTransactions()
    {
        $paginate = 20;
        $whereBetween = [];
        $conditions = [];
        return $this->transaction->getTransactions($conditions, $whereBetween, $paginate);
    }

    public function getTransactionByInvoice($data){

        $conditions = $this->getCondtionsParams($data);
        return $this->transaction->getTransactionByInvoice($conditions);
    }
}
