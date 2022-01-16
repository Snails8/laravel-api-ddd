<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class ServiceMakeCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Service class';

    // $typeを設定しておくとコマンドを実行して成功した場合などに Service created successfully. と表示してくれる
    protected $type = 'Service';

    /**
     * 生成に使うスタブファイルを取得する
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/stubs/service.stub';
    }

    /**
     * クラスのデフォルトの名前空間を取得する(指定しないとAPP以下に作成される)
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace . '\Services';
    }

    /**
     * InputArgumentのコンストラクタへ渡す引数の配列のリストを返します
     *
     * @return array
     */
    protected function getArguments(): array
    {
        // GeneratorCommandでクラス名を受け取る引数(name)を定義しているのでマージする
        return array_merge(
            parent::getArguments(),
            [
                // InputArgumentのコンストラクタへ渡す引数の配列を追加していく
                // ここに引数を表現する配列を追加していく
                // 左から
                // @param string               $name        引数名
                // @param int|null             $mode        引数のモード(self::REQUIREDとself::OPTIONALはどちらか一つ)
                // @param string               $description 引数の説明
                // @param string|string[]|null $default     引数の初期値(引数のモードにself::OPTIONALを指定している場合のみ)
                ['argName', InputArgument::REQUIRED, 'the argument description']

            ]
        );
    }

    /**
     * InputOptionのコンストラクタへ渡す引数の配列のリストを返します
     *
     * @return array
     */
    protected function getOptions(): array
    {
        return [
            // InputOptionのコンストラクタへ渡す引数の配列を追加していく
            // 左から
            // @param string                        $name        オプション名
            // @param string|array|null             $shortcut    オプションショートカット
            // @param int|null                      $mode        オプションのモード(self::VALUE_NONEとself::VALUE_REQUIREDとself::VALUE_OPTIONALはどれか一つ)
            // @param string                        $description オプションの説明
            // @param string|string[]|int|bool|null $default     オプションの初期値(オプションのモードにself::VALUE_NONE以外を指定している場合のみ)
            ['optName', 'o', InputOption::VALUE_OPTIONAL, 'the option description'],
        ];
    }

    /**
     * 指定された名前でクラスを構築する
     *
     * @param  string  $name
     * @return string
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    protected function buildClass($name): string
    {
        // 引数やオプションなどを使い'置換前'=>'置換後'のような配列を作る
        $replace = [
            'DummyAuthor' => $this->option('author')
        ];

        return str_replace(
            array_keys($replace),
            array_values($replace),
            parent::buildClass($name)
        );
    }
}
