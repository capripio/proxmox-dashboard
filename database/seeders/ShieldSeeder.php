<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use BezhanSalleh\FilamentShield\Support\Utils;
use Spatie\Permission\PermissionRegistrar;

class ShieldSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $rolesWithPermissions = '[{"name":"super_admin","guard_name":"web","permissions":["view_role","view_any_role","create_role","update_role","delete_role","delete_any_role","view_user","view_any_user","create_user","update_user","restore_user","restore_any_user","replicate_user","reorder_user","delete_user","delete_any_user","force_delete_user","force_delete_any_user","view_i::p","view_any_i::p","create_i::p","update_i::p","restore_i::p","restore_any_i::p","replicate_i::p","reorder_i::p","delete_i::p","delete_any_i::p","force_delete_i::p","force_delete_any_i::p","view_invoice","view_any_invoice","create_invoice","update_invoice","restore_invoice","restore_any_invoice","replicate_invoice","reorder_invoice","delete_invoice","delete_any_invoice","force_delete_invoice","force_delete_any_invoice","view_order","view_any_order","create_order","update_order","restore_order","restore_any_order","replicate_order","reorder_order","delete_order","delete_any_order","force_delete_order","force_delete_any_order","view_order::item","view_any_order::item","create_order::item","update_order::item","restore_order::item","restore_any_order::item","replicate_order::item","reorder_order::item","delete_order::item","delete_any_order::item","force_delete_order::item","force_delete_any_order::item","view_proxmox::server","view_any_proxmox::server","create_proxmox::server","update_proxmox::server","restore_proxmox::server","restore_any_proxmox::server","replicate_proxmox::server","reorder_proxmox::server","delete_proxmox::server","delete_any_proxmox::server","force_delete_proxmox::server","force_delete_any_proxmox::server","view_template","view_any_template","create_template","update_template","restore_template","restore_any_template","replicate_template","reorder_template","delete_template","delete_any_template","force_delete_template","force_delete_any_template","view_transaction","view_any_transaction","create_transaction","update_transaction","restore_transaction","restore_any_transaction","replicate_transaction","reorder_transaction","delete_transaction","delete_any_transaction","force_delete_transaction","force_delete_any_transaction","view_virtual::machine","view_any_virtual::machine","create_virtual::machine","update_virtual::machine","restore_virtual::machine","restore_any_virtual::machine","replicate_virtual::machine","reorder_virtual::machine","delete_virtual::machine","delete_any_virtual::machine","force_delete_virtual::machine","force_delete_any_virtual::machine"]},{"name":"panel_user","guard_name":"web","permissions":[]}]';
        $directPermissions = '[]';

        static::makeRolesWithPermissions($rolesWithPermissions);
        static::makeDirectPermissions($directPermissions);

        $this->command->info('Shield Seeding Completed.');
    }

    protected static function makeRolesWithPermissions(string $rolesWithPermissions): void
    {
        if (! blank($rolePlusPermissions = json_decode($rolesWithPermissions, true))) {
            /** @var Model $roleModel */
            $roleModel = Utils::getRoleModel();
            /** @var Model $permissionModel */
            $permissionModel = Utils::getPermissionModel();

            foreach ($rolePlusPermissions as $rolePlusPermission) {
                $role = $roleModel::firstOrCreate([
                    'name' => $rolePlusPermission['name'],
                    'guard_name' => $rolePlusPermission['guard_name'],
                ]);

                if (! blank($rolePlusPermission['permissions'])) {
                    $permissionModels = collect($rolePlusPermission['permissions'])
                        ->map(fn ($permission) => $permissionModel::firstOrCreate([
                            'name' => $permission,
                            'guard_name' => $rolePlusPermission['guard_name'],
                        ]))
                        ->all();

                    $role->syncPermissions($permissionModels);
                }
            }
        }
    }

    public static function makeDirectPermissions(string $directPermissions): void
    {
        if (! blank($permissions = json_decode($directPermissions, true))) {
            /** @var Model $permissionModel */
            $permissionModel = Utils::getPermissionModel();

            foreach ($permissions as $permission) {
                if ($permissionModel::whereName($permission)->doesntExist()) {
                    $permissionModel::create([
                        'name' => $permission['name'],
                        'guard_name' => $permission['guard_name'],
                    ]);
                }
            }
        }
    }
}
