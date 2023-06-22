<?php

namespace App\Modules\Material\Clients;

use App\Models\material;
use App\Modules\Material\Clients\Contracts\MaterialClientInterface;
use Illuminate\Database\Eloquent\Collection;

class MaterialClient implements MaterialClientInterface
{
	function all(): Collection
	{
		return material::all();
	}

	function get(string $search, string $variable): Collection
	{
		return material::where($search, $variable)->get();
	}

	public function getMaterials(): Collection
	{
		return material::select('id', 'name', 'quantity', 'image')->get();
	}

	public function addMaterial(array $material): material
	{
		return material::create($material);
	}

	public function removeMaterial(int $id): int
	{
		$material = material::find($id);
		if ($material) {
			return $material->delete();
		}
		return 0;
	}
}
