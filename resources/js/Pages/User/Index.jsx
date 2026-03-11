import AdminLayout from '@/Layouts/AdminApp'
import { Head, Link, usePage, router } from '@inertiajs/react'
import Alert from '@/Components/Alert'
import { formatDate } from '@/Utils/Date'
import Swal from 'sweetalert2'

export default function Index({ users }) {
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
                router.delete(`/admin-panel/user/${id}`, {
                    preserveScroll: true
                })
            }
        })
    }

    return (
        <AdminLayout>
            <Head title="User List" />
            <section className="content-header">
                <div className="container-fluid">
                    <div className="row mb-2">
                        <div className="col-sm-6">
                            <h1>Users</h1>
                        </div>
                        <div className="col-sm-6">
                            <ol className="breadcrumb float-sm-right">
                                <li className="breadcrumb-item"><Link href="/admin-panel/dashboard">Dashboard</Link></li>
                                <li className="breadcrumb-item active">User</li>
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
                                    {permissions.includes('admin.user.list.create') && (
                                        <Link href="/admin-panel/user/create" className="btn btn-primary btn-sm">
                                            <i className="fas fa-plus mr-1"></i> Add User
                                        </Link>
                                    )}
                                </div>
                                <div className="card-body">
                                    <table id="datatable-simple" className="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Status</th>
                                                <th>Role</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Created at</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {users.map((user) => (
                                                <tr key={user.id}>
                                                    <td>{user.id}</td>
                                                    <td>
                                                        {user.is_active ? (
                                                            <span className="badge bg-success">Active</span>
                                                        ) : (
                                                            <span className="badge bg-danger">Inactive</span>
                                                        )}
                                                    </td>
                                                    <td>{user.role?.name}</td>
                                                    <td>{user.name}</td>
                                                    <td>{user.email}</td>
                                                    <td>{formatDate(user.created_at)}</td>
                                                    <td>
                                                        {permissions.includes('admin.user.list.edit') && (
                                                            <Link 
                                                                href={`/admin-panel/user/${user.id}/edit`} 
                                                                className="btn btn-xs btn-info"
                                                                style={{ marginRight: '5px' }}
                                                            >
                                                                <i className="fas fa-pencil-alt"></i>
                                                            </Link>
                                                        )}
                                                        {permissions.includes('admin.user.list.delete') && (
                                                            <button 
                                                                type="button" 
                                                                className="btn btn-xs btn-danger" 
                                                                onClick={() => confirmSubmit(user.id)}
                                                            >
                                                                <i className="fas fa-trash"></i>
                                                            </button>
                                                        )}
                                                    </td>
                                                </tr>
                                            ))}
                                            {users.length === 0 && (
                                                <tr>
                                                    <td colSpan="7" className="text-center">Data not found.</td>
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