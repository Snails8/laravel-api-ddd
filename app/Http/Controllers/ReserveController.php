<?php

namespace App\Http\Controllers;

use App\Mail\ReserveMail;
use App\Models\Reserve;
use App\Http\Requests\ReservePostRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ReserveController extends Controller
{
    public function showForm(): View
    {
        $title = '';
        $description = '';

        $data = [
            'title' => $title,
            'description' => $description,
        ];

        return view('reserve.index', $data);
    }

    /**
     * @param ReservePostRequest $request
     * @return RedirectResponse
     */
    public function submit(ReservePostRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        DB::beginTransaction();
        try {
            $reserve = new Reserve();

            $reserve->fill($validated)->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            Log::critical('データ保存中に本題が発生しました。ユーザー情報'. implode(' / ', $validated));
            abort('500', 'データ保存中に本題が発生しました。');
        }

        // Laravel において mailに関してのみ queue を指定するだけでjobを書かなくとも実行してくれる
        Mail::queue(new ReserveMail($validated));
        return redirect()->route('reserve.thanks');
    }


    /**
     * @return View
     */
    public function showThanks(): View
    {
        $title = 'Thanks';
        $description = 'sample Thanks';

        $data = [
            'title'       => $title,
            'description' => $description,
        ];

        return view('reserve.thanks', $data);
    }
}
