<?php

namespace tests;

use src\LongestCommonEnding;
use PHPUnit\Framework\TestCase;

final class LongestCommonEndingTest extends TestCase
{
    public function test_set_words(): void
    {
        $longestCommonEnding = new LongestCommonEnding;

        $words = ['multiplication', 'ration'];

        $longestCommonEnding->setWords($words);

        $this->assertEqualsCanonicalizing($words, $longestCommonEnding->getWords());
    }

    public function test_set_words_only_accepts_valid_arrays(): void
    {
        $this->expectException(\LengthException::class);

        $longestCommonEnding = new LongestCommonEnding;

        $words = ['multiplication', 'ration', 'nation'];

        $longestCommonEnding->setWords($words);
    }

    public function test_set_words_only_accepts_alpha_values(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $longestCommonEnding = new LongestCommonEnding;

        $words = ['123', 'nation'];

        $longestCommonEnding->setWords($words);
    }
    
    public function test_get_words(): void
    {
        $longestCommonEnding = new LongestCommonEnding;

        $this->assertEqualsCanonicalizing([], $longestCommonEnding->getWords());
    }

    /**
     * Test the method longest common ending
     *
     * @dataProvider wordsDataProvider
     * @param array $words
     * @param string $expected
     *
     * @return void
     */
    public function test_longest_common_ending(array $words, string $expected): void
    {
        $longestCommonEnding = new LongestCommonEnding;

        $longestCommonEnding->setWords($words);

        $result = $longestCommonEnding->getLongestCommonEnding();

        $this->assertEquals($expected, $result);
    }

    public function test_longest_common_ending_not_runs_without_set_words(): void
    {
        $this->expectException(\LengthException::class);

        $longestCommonEnding = new LongestCommonEnding;

        $longestCommonEnding->getLongestCommonEnding();
    }

    public static function wordsDataProvider(): array
    {
        return [
            'test-1' => [['multiplication', 'ration'], 'ation'],
            'test-2' => [['potent', 'tent'], 'tent'],
            'test-3' => [['skyscraper', 'carnivore'], ''],
        ];
    }
}