<?php

namespace Tests\Feature\Controller\Admin;

use Tests\TestCase;
use App\Models\User;
use App\Models\Work;

/**
 * Class WorkControllerTest
 * @package Tests\Feature\Controller\Admin
 */
class WorkControllerTest extends TestCase
{
    /**
     * @test
     */
    public function 実装例管理一覧画面のレスポンスは正常である()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'admin')
            ->get(route('admin.work.index'))->assertStatus(200);
    }

    /**
     * @test
     */
    public function 実装例管理作成画面のレスポンスは正常である()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'admin')
            ->get(route('admin.work.create'))->assertStatus(200);
    }

    /**
     * @test
     */
    public function 実装例管理編集画面のレスポンスは正常である()
    {
        $user = User::factory()->create();
        $usageCase = Work::query()->inRandomOrder()->first();

        $this->actingAs($user, 'admin')
            ->get(route('admin.work.edit', ['work' => $usageCase->id]))->assertStatus(200);
    }

    /**
     * @test
     */
    public function 実装例管理新規登録処理のレスポンスは正常である()
    {
        $user = User::factory()->create();
        // formDataの用意
        $postData = $this->getPostData();

        $res = $this->actingAs($user, 'admin')
            // fromでリファラーを指定しないとテストの仕様上、発見できずback()でホームに飛ばされる
            ->from(route('admin.work.index'))
            ->post(route('admin.work.store'), $postData);

        $res->assertRedirect(route('admin.work.index'));
    }

    /**
     * @test
     */
    public function 実装例管理更新処理のレスポンスは正常である()
    {
        $user = User::factory()->create();
        // putなのでデータ取得用に
        $updateWork = Work::query()->inRandomOrder()->first();

        $postData = $this->getPostData();

        $res = $this->actingAs($user, 'admin')
            ->from(route('admin.work.index'))
            ->put(route('admin.work.update', ['work' => $updateWork->id]), $postData);

        $res->assertRedirect(route('admin.work.index'));
    }

    /**
     * @return array
     */
    private function getPostData(): array
    {
        $postData = [
            'title'    => 'テスト',
            'image'    => '',
            'introduction'  => 'aaaaaaaaaaaaaaaaaaaaaaaaa',
            'hr_company_id' => 1,
        ];

        return $postData;
    }
}