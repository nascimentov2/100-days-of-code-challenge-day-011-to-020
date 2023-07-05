<?php

namespace tests;

use src\ChangeTheWord;
use PHPUnit\Framework\TestCase;

final class ChangeTheWordTest extends TestCase
{
    public function test_set_word(): void
    {
        $changeTheWord = new ChangeTheWord;

        $changeTheWord->setWord('word');

        $this->assertEquals('word', $changeTheWord->getWord());
    }

    public function test_get_word(): void
    {
        $changeTheWord = new ChangeTheWord;

        $this->assertEquals('', $changeTheWord->getWord());
    }

    public function test_set_word_not_accepts_empty_values(): void
    {
        $this->expectException(\LengthException::class);

        $changeTheWord = new ChangeTheWord;
        
        $changeTheWord->setWord('');
    }

    /**
     * Test set word not accepts non ctype alpha characteres
     *
     * @dataProvider invalidWordsDataProvider
     * @param string $word
     * 
     * @return void
     */
    public function test_set_word_not_accepts_invalid_values(string $word): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $changeTheWord = new ChangeTheWord;
        
        $changeTheWord->setWord($word);
    }

    /**
     * Test change the word method
     *
     * @dataProvider wordsDataProvider
     * @param string $word
     * @param string $expected
     *
     * @return void
     */
    public function test_change(string $word, string $expected): void
    {
        $changeTheWord = new ChangeTheWord;

        $changeTheWord->setWord($word);

        $this->assertEquals($expected, $changeTheWord->change());
    }

    public static function wordsDataProvider(): array
    {
        return [
            'word-1' => ["ApPle", "ELQPB"],
            'word-2' => ["draGON", "OPHARD"],
            'word-3' => ["ZebrA", "BRBEA"],
        ];
    }

    public static function invalidWordsDataProvider(): array
    {
        return [
            'numbers' => ["123456"],
            'mixed'   => ["l0V3"],
            'misc'    => ["A\hn!@3#"],
        ];
    }
}