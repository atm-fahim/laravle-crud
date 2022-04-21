<?php

namespace App\Repository;

use App\Models\StudentInfo;
use Illuminate\Support\Facades\DB;

class StudentInfoRepository implements StudentInfoInterface
{
    public function getStudents()
    {
        return StudentInfo::where('status', 1)->get();
    }

    public function save($data)
    {
      return StudentInfo::insert($data);
    }

    public function getStores()
    {
        return Stores::select('id', 'username')->get();
    }

    public function getMerchantWiseStore($merchant_id)
    {

        return Stores::where('merchant_id', $merchant_id)->get();
    }

    public function getTransactions($conditions, $whereBetween, $perPage)
    {

        $query = ThreeMonthDtata::leftjoin('store_info', 'last_three_month_data.store_id', 'store_info.id')
            ->select('last_three_month_data.id', 'last_three_month_data.bank_trx_id','last_three_month_data.sp_code',
                'last_three_month_data.merchant_id', 'last_three_month_data.invoice_no',
                'last_three_month_data.full_amount', 'last_three_month_data.merchant_payable','last_three_month_data.in_payable',
                'last_three_month_data.commission_amt', 'last_three_month_data.sp_massage',
                'last_three_month_data.method_name', 'last_three_month_data.refund_amount','last_three_month_data.store_username',
                'last_three_month_data.amount_recived', 'last_three_month_data.refund_code','store_info.is_add_commission',
              'last_three_month_data.commission', 'last_three_month_data.currency', 'last_three_month_data.created_at');
        if (!empty($conditions)) {
            $query->where($conditions);
        }
        if (!empty($whereBetween)) {
            $query->whereBetween('last_three_month_data.created_at', $whereBetween);
        }
        return $query->paginate($perPage);
    }

    public function countTotalSuccessTransactions($whereBetween, $conditions)
    {

        $query = DB::table('last_three_month_data')->select(DB::raw('count(id) as total_transactions,sum(amount_recived) as total_amount'));
        if (!empty($whereBetween)) {
            $query->whereBetween('created_at', $whereBetween);
        }
        return $query->where($conditions)->get();


    }

    public function getTransactionDetailsById($transaction_id)
    {

        return DB::table('last_three_month_data')
            ->where('last_three_month_data.id', $transaction_id)
            ->leftJoin('customer_info', 'last_three_month_data.order_id', '=', 'customer_info.order_id')
            ->leftJoin('store_info', 'last_three_month_data.store_id', '=', 'store_info.id')
            ->leftJoin('merchant_info', 'last_three_month_data.merchant_id', '=', 'merchant_info.id')
            ->select('customer_info.*', 'store_info.*', 'merchant_info.*', 'last_three_month_data.*')
            ->first();

    }

    public function getMerchantById($merchant_id)
    {
        return Merchants::where('status', '1')->where('id', $merchant_id)->select('id', 'merchant_name')->get();
    }

    public function getExportTransactions($conditions, $whereBetween)
    {

        $query = ThreeMonthDtata::leftjoin('store_info', 'last_three_month_data.store_id', 'store_info.id')
                    ->leftjoin('merchant_info', 'last_three_month_data.merchant_id', '=', 'merchant_info.id');

        if (!empty($conditions)) {
            $query->where($conditions);
        }
        if (!empty($whereBetween)) {
            $query->whereBetween('last_three_month_data.created_at', $whereBetween);
        }
        return $query->select(
            'last_three_month_data.id',
            'store_info.is_add_commission',
            'merchant_info.merchant_name',
            'last_three_month_data.full_amount',
            'last_three_month_data.sp_code',
            'last_three_month_data.refund_code',
            'last_three_month_data.order_id',
            'last_three_month_data.bank_trx_id',
            'last_three_month_data.merchant_id',
            'last_three_month_data.invoice_no',
            'last_three_month_data.amount_recived',
            'last_three_month_data.commission_amt',
            'last_three_month_data.in_payable',
            'last_three_month_data.sp_massage',
            'last_three_month_data.merchant_payable',
            'last_three_month_data.method_name',
            'last_three_month_data.commission',
            'last_three_month_data.currency',
            'last_three_month_data.created_at')->get();
    }

    public function getTransactionByInvoice($conditions)
    {

        $query = DB::table('last_three_month_data');
        if (!empty($conditions)) {
            $query->where($conditions);
        }
        return $query->get();
    }

}
