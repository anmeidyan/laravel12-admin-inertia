import AdminLayout from '@/Layouts/AdminApp'
import { Head, Link, usePage, router } from '@inertiajs/react'
import Alert from '@/Components/Alert'
import { formatDate } from '@/Utils/Date'
import Swal from 'sweetalert2'

export default function Index({ roles }) {
    const { permissions } = usePage().props;

    function confirmSubmit(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'This data will be deleted',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it'
        }).then((result) => {
            if (result.isConfirmed) {
                router.delete(`/admin-panel/role/${id}`, {
                    preserveScroll: true
                })
            }
        })
    }

    return (
        <AdminLayout>
            <Head title="Role List" />
            <section className="content-header">
                <div className="container-fluid">
                    <div className="row mb-2">
                        <div className="col-sm-6">
                            <h1>Roles</h1>
                        </div>
                        <div className="col-sm-6">
                            <ol className="breadcrumb float-sm-right">
                                <li className="breadcrumb-item"><Link href="/admin-panel/dashboard">Dashboard</Link></li>
                                <li className="breadcrumb-item active">Role</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>

            <section className="content">
                <div className="container-fluid">
                    <Alert />
                    <div className="row">
                        <div className="col-12">
                            <div className="card">
                                <div className="card-header">
                                    {permissions.includes('admin.user.role.create') && (
                                        <Link href="/admin-panel/role/create" className="btn btn-primary btn-sm">
                                            <i className="fas fa-plus mr-1"></i> Add Role
                                        </Link>
                                    )}
                                </div>
                                <div className="card-body">
                                    <table id="datatable-simple" className="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Status</th>
                                                <th>Name</th>
                                                <th>Slug</th>
                                                <th>Created at</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {roles.map((role) => (
                                                <tr key={role.id}>
                                                    <td>{role.id}</td>
                                                    <td>
                                                        {role.is_active ? (
                                                            <span className="badge bg-success">Active</span>
                                                        ) : (
                                                            <span className="badge bg-danger">Inactive</span>
                                                        )}
                                                    </td>
                                                    <td>{role.name}</td>
                                                    <td>{role.slug}</td>
                                                    <td>{formatDate(role.created_at)}</td>
                                                    <td>
                                                        {permissions.includes('admin.user.role.edit') && (
                                                            <Link 
                                                                href={`/admin-panel/role/${role.id}/edit`} 
                                                                className="btn btn-xs btn-info"
                                                                style={{ marginRight: '5px' }}
                                                            >
                                                                <i className="fas fa-pencil-alt"></i>
                                                            </Link>
                                                        )}
                                                        {permissions.includes('admin.user.role.delete') && (
                                                            <button 
                                                                type="button" 
                                                                className="btn btn-xs btn-danger" 
                                                                onClick={() => confirmSubmit(role.id)}
                                                            >
                                                                <i className="fas fa-trash"></i>
                                                            </button>
                                                        )}
                                                    </td>
                                                </tr>
                                            ))}
                                            {roles.length === 0 && (
                                                <tr>
                                                    <td colSpan="6" className="text-center">Data not found.</td>
                                                </tr>
                                            )}
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </AdminLayout>
    )
}