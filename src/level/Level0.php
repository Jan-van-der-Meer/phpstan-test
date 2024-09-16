<?php 
NAMESPACE Medi\Line\Vega\Util;

class Level0
{
    public function testAction() {
        // $this->unknownMethod();    // 存在しないメソッドを呼び出しているためエラー
        $this->knownMethod();  // 引数が足りないためエラー
        $this->knownMethod("String", "test");  // レベル０では引数が超過している場合はエラーにならない
    }

    private function knownMethod($test)
    {
        // do the work
    }
}