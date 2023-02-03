<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'position_id',
        'department_id',
        'personnel_code',
        'email',
        'password',
        'fullname',
        'phone',
        'date_of_birth',
        'address',
        'status',
        'recruitment_date',
        'img_url',
        'level',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Always encrypt the password when it is updated.
     *
     * @param $value
     * @return string
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
    public static function UserBuild($nhansu)
    {
        $html = '
        <div class="table-responsive p-0">
        <table class="table align-items-center mb-0">
            <thead>
                <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Mã
                        Nhân
                        Sự</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Họ
                        Tên
                    </th>
                    <th
                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                        Email</th>
                    <th <th
                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                        Chức Vụ</th>
                    <th
                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        Phòng Ban</th>
                    <th
                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        Trạng Thái</th>
                    <th
                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        Action</th>
                </tr>
            </thead>
            <tbody> ';
        foreach ($nhansu as $ns) {
            $html .= '
                    <tr>
                        <td class="">
                            <p class="text-sm font-weight-bold mb-0">' . $ns->personnel_code . ' </p>
                        </td>
                        <td>
                            <div class="d-flex px-3 py-1">
                                <div>
                                    <img src="https://i.pravatar.cc/150?img=62" class="avatar me-3"
                                        alt="Avatar">
                                </div>
                                <div class="d-flex flex-column justify-content-center">
                                    <h6 class="mb-0 text-sm">' . $ns->fullname . '</h6>
                                </div>
                            </div>
                        </td>
                        <td>
                            <p class="text-sm font-weight-bold mb-0">' . $ns->email . '</p>
                        </td>
                        <td>
                            <p class="text-sm font-weight-bold mb-0">' . $ns->position_id . '</p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <p class="text-sm font-weight-bold mb-0">' . $ns->department_id . '</p>
                        </td>
                        <td class="align-middle text-center text-sm"> ';
            if ($ns->status === 1) {
                $html .= '
                            <span class ="badge badge-sm bg-gradient-success">Hoạt Động</span>';
            }
            if ($ns->status === 0) {
                $html .= '<span class="badge badge-sm bg-gradient-secondary">Không Hoạt Động</span> ';
            }
            $html .= '</td>
                        <td class="align-middle text-end">
                            <div class="d-flex px-3 py-1 justify-content-center align-items-center">    
                                <a class="text-sm font-weight-bold mb-0 " id="btn-del"
                                    onclick="onDelete(' . $ns->id . ')">
                                    Delete
                                </a>
                                <a id="btn-edit" data-bs-toggle="offcanvas"
                                    onclick="getdetail(' . $ns->id . ')"
                                    data-bs-target="#offcanvasNavbarupdate"
                                    class="text-sm font-weight-bold mb-0 ps-2">
                                    Edit
                                </a>
                            </div>
                        </td>
                    </tr> ';
        }
        $html .= '
            </tbody>
        </table>
        ' . $nhansu->LINKS() . '
    </div> ';
        return $html;
    }
}
