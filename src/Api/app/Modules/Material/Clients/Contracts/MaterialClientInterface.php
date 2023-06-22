<?php

namespace App\Modules\Material\Clients\Contracts;

use App\Models\material;
use Illuminate\Database\Eloquent\Collection;

interface MaterialClientInterface
{
	function all(): Collection;

	function get(string $search, string $variable): Collection;

	function getMaterials(): Collection;

	function addMaterial(array $material): material;

	function removeMaterial(int $id): int;
}
