<?php


namespace App\Transformers;


use App\Models\Investment;
use App\Traits\Constants;
use Carbon\Carbon;

class InvestmentTransformer
{
    use Constants;

    public function transform(Investment $investment)
    {
        if(in_array($investment->status , [$this->pendingStatus , $this->cancelledStatus])){
            $progress = 0;
        }
        else{
            $start = Carbon::parse($investment->start_date);
            $diff = $start->diffInWeekdays(now() , false);
            $progress = ( ($diff * 100) / $investment->duration );
            if($progress > 100){
                $progress = 100;
            }
        }

        $total = (($investment->amount + (($investment->amount * $investment->percent) / 100)) - $investment->fees);

         return [
             'id' => $investment->id,
             'narration' => $investment->narration,
             'reference' => $investment->reference,
             'amount' => format_money($investment->amount),
             'fees' => format_money($investment->fees),
             'progress' => $progress,
             'total' => format_money($total),
             'status' => $investment->getStatus(),
             'percent' => $investment->percent,
             'duration' => $investment->duration,
             'extension' => $investment->extension,
             'start_date' => format_date($investment->start_date),
             'end_date' => format_date($investment->end_date),
             'created_at' => format_date($investment->created_at),
             'updated_at' => format_date($investment->updated_at),

         ];
    }

    public function collect($collection)
    {
        $transformer = new InvestmentTransformer ();
        return collect($collection)->map(function ($model) use ($transformer) {
            return $transformer->transform($model);
        });
    }

}
