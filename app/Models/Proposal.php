<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'status',
        'message',
        'comment',
    ];

    /**
     * @param array $data
     * @return mixed
     */
    public function createProposal(array $data): mixed
    {
        $fields = [];

        foreach (array_keys($data) as $value) {
            $fields[$value] = $data[$value];
        }

        $fields['status'] = 'Active';
        return $this::create($fields);
    }

    /**
     * @param null $status
     * @param null $date
     */
    //перенести status в Enum
    public function findAll(
        $status = null,
        $date = null
    )
    {
        $query = Proposal::limit(10);

        if ($status === 'Active' || $status === 'Resolved') {
            return $query->where('status', $status)->get()->sortBy('updated_at');
        }

        if ($date) {
            return $query->where('updated_at', '>', $date)->get()->sortBy('updated_at');
        }

        return $query->get()->sortBy('updated_at');
    }

    /**
     * @param $data
     * @param $id
     * @return mixed
     */
    public function putRequest($data, $id): mixed
    {
        return $this::findOrFail($id)
            ->fill(['comment' => $data['comment']])
            ->fill(['status' => 'Resolved'])
            ->save();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findById($id): mixed
    {
        return $this::findOrFail($id);
    }
}
