<?php

namespace Tests\Feature;

use App\Http\Requests\CreateTask;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Log;
class TaskTest extends TestCase
{
	use RefreshDatabase;
	
	public function setUp():void
	{
		parent::setUp();
		
		//テストケース実行前にフォルダーデータを作成。
		$this->seed('FoldersTableSeeder');
	}
	
	
    /**
     * 期限日が日付ではない場合はバリデーションエラー
     * @test
     */
    public function due_date_should_be_date()
    {
        $response = $this->post('/folders/1/tasks/create', [
            'title' => 'Sample task',
            'sue_date' => 123,
		]);
        $response->assertSessionHasErrors([
            'sue_date' => '期限日には日付を入力してください。',
        ]);
    }

	/**
	 * @test
	 */
	public function due_date_should_not_be_post()
	{
		$response = $this->post('/folders/1/tasks/create',[
			'title' => 'Sample task',
			'sue_date' => Carbon::yesterday()->format('Y/m/d'),//不正なデータ(昨日の日付))
		]);
		

		$response->assertSessionHasErrors([
			'sue_date' => '期限日には今日以降の日付を入力してください。'
		]);
			
		
	}
	
}