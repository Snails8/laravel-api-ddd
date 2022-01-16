<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\WorkPostRequest;
use App\Models\Work;
use App\Services\UtilityService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * 実装例 管理
 */
class WorkController extends Controller
{
    const SELECT_LIMIT = 15;
    private $utility;

    /**
     *WorkController constructor.
     * @param UtilityService $utility
     */
    public function __construct(UtilityService $utility)
    {
        $this->utility = $utility;
    }

    /**
     * 一覧
     * @Method GET
     * @param  Request  $request
     * @return View
     */
    public function index(Request $request): View
    {
        $params = $this->utility->initIndexParamsForAdmin($request);
        $works = $this->utility->getSearchResultAtPagerByColumn('Work', $params, 'title',  self::SELECT_LIMIT, false);

        $title = '実装例 一覧';

        $data = [
            'works' => $works,
            'params'     => $params,
            'title'      => $title,
        ];

        return view('admin.work.index', $data);
    }

    /**
     * 新規作成画面
     * @Method GET
     * @param Work  $work
     * @return View
     */
    public function create(Work $work): View
    {
        $title = '実装例 新規作成';

        $data = [
            'work'   => $work,
            'title'  => $title,
        ];

        return view('admin.work.create', $data);
    }

    /**
     * 編集画面
     * @Method GET
     * @param Work $work
     * @return View
     */
    public function edit(Work $work): View
    {
        $title = '実装例 編集: '. $work->title;

        $data = [
            'work' => $work,
            'title'     => $title,
        ];

        return view('admin.work.edit', $data);
    }

    /**
     * 新規保存処理
     * @Method POST
     * @param WorkPostRequest  $request
     * @return RedirectResponse
     * @throws \Exception
     */
    public function store(WorkPostRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        DB::beginTransaction();
        try {
            $work = new Work;
            $work->fill($validated)->save();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            Log::critical($e->getMessage());

            session()->flash('critical_error_message', '保存中に問題が発生しました。');
            return redirect()->back()->withInput();
        }

        session()->flash('flash_message', '新規作成が完了しました');

        return redirect()->route('admin.work.index');
    }

    /**
     * アップデート
     * @Method PUT
     * @param WorkPostRequest $request
     * @param Work  $work
     * @return RedirectResponse
     * @throws \Throwable
     */
    public function update(WorkPostRequest $request, Work $work): RedirectResponse
    {
        $validated = $request->validated();

        DB::beginTransaction();
        try {
            $work->fill($validated)->save();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            Log::critical($e->getMessage());

            session()->flash('critical_error_message', '保存中に問題が発生しました。');
            return redirect()->back()->withInput();
        }

        session()->flash('flash_message', '更新が完了しました');

        return redirect()->route('admin.work.index');
    }

    /**
     * 削除
     * @Method DELETE
     * @param Work  $work
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(Work $work): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $work->delete();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();

            Log::critical($e->getMessage());
            session()->flash('critical_error_message', '削除中に問題が発生しました。');

            return redirect()->back()->withInput();
        }

        session()->flash('flash_message', $work->title.'を削除しました');

        return redirect()->route('admin.work.index');
    }
}
