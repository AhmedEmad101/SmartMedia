<?php
namespace App\DTOs;
final class getPostsData
{
    public function __construct(
        public ?int $userId = null,
        public ?string $search = null,
        public int $page = 1,
        public int $limit = 10,
    ) {}

    public static function fromRequest($request): self
    {
        return new self(
            userId: $request->input('user_id'),
            search: $request->input('search'),
            page: $request->input('page', 1),
            limit: $request->input('limit', 10),
        );
    }
}
