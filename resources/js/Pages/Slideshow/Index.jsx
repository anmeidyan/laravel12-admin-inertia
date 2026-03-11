import AdminLayout from '@/Layouts/AdminApp'
import { Head, Link, usePage, router } from '@inertiajs/react'
import Alert from '@/Components/Alert'
import { formatDate } from '@/Utils/Date'
import Swal from 'sweetalert2'

export default function Index({ slideshows }) {
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
                router.delete(`/admin-panel/slideshow/${id}`, {
                    preserveScroll: true
                })
            }
        })
    }

    return (
        <AdminLayout>
            <Head title="Slideshow" />
            <section className="content-header">
                <div className="container-fluid">
                    <div className="row mb-2">
                        <div className="col-sm-6">
                            <h1>Slideshows</h1>
                        </div>
                        <div className="col-sm-6">
                            <ol className="breadcrumb float-sm-right">
                                <li className="breadcrumb-item"><Link href="/admin-panel/dashboard">Dashboard</Link></li>
                                <li className="breadcrumb-item active">Slideshow</li>
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
                                    {permissions.includes('admin.slideshow.create') && (
                                        <Link href="/admin-panel/slideshow/create" className="btn btn-primary btn-sm">
                                            <i className="fas fa-plus mr-1"></i> Add Slideshow
                                        </Link>
                                    )}
                                </div>
                                <div className="card-body">
                                    <table id="datatable-simple" className="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Status</th>
                                                <th>Title</th>
                                                <th>Description</th>
                                                <th>Image</th>
                                                <th>Created at</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {slideshows.map((slideshow) => (
                                                <tr key={slideshow.id}>
                                                    <td>{slideshow.id}</td>
                                                    <td>
                                                        {slideshow.is_active ? (
                                                            <span className="badge bg-success">Active</span>
                                                        ) : (
                                                            <span className="badge bg-danger">Inactive</span>
                                                        )}
                                                    </td>
                                                    <td>{slideshow.title}</td>
                                                    <td>{slideshow.description}</td>
                                                    <td>
                                                        {slideshow.image_path && (
                                                            <a href={`${window.location.origin}${slideshow.image_path}`} target="_blank">
                                                                <img 
                                                                    src={`${window.location.origin}${slideshow.image_path}`} 
                                                                    alt="Image" 
                                                                    className="img-fluid" 
                                                                    width="100" 
                                                                />
                                                            </a>
                                                        )}
                                                    </td>
                                                    <td>{formatDate(slideshow.created_at)}</td>
                                                    <td>
                                                        {permissions.includes('admin.slideshow.edit') && (
                                                            <Link 
                                                                href={`/admin-panel/slideshow/${slideshow.id}/edit`} 
                                                                className="btn btn-xs btn-info"
                                                                style={{ marginRight: '5px' }}
                                                            >
                                                                <i className="fas fa-pencil-alt"></i>
                                                            </Link>
                                                        )}
                                                        {permissions.includes('admin.slideshow.delete') && (
                                                            <button 
                                                                type="button" 
                                                                className="btn btn-xs btn-danger" 
                                                                onClick={() => confirmSubmit(slideshow.id)}
                                                            >
                                                                <i className="fas fa-trash"></i>
                                                            </button>
                                                        )}
                                                    </td>
                                                </tr>
                                            ))}
                                            {slideshows.length === 0 && (
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