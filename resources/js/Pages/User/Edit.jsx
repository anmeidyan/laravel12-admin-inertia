import AdminLayout from '@/Layouts/AdminApp'
import { Head, Link, useForm } from '@inertiajs/react'

export default function Edit({ user,roles }) {
    const { data, setData, put, processing, errors, clearErrors } = useForm({
            is_active: user.is_active,
            role_id: user.role_id,
            name: user.name,
            email: user.email,
            password: ""
    })

    function submit(e){
        e.preventDefault()

        put(`/admin-panel/user/${user.id}`, {
            preserveScroll: true
        })
    }

    return (
        <AdminLayout>
            <Head title="Edit User" />
            <section className="content-header">
                <div className="container-fluid">
                    <div className="row mb-2">
                        <div className="col-sm-6">
                            <h1>Edit User</h1>
                        </div>
                        <div className="col-sm-6">
                            <ol className="breadcrumb float-sm-right">
                                <li className="breadcrumb-item"><Link href="/admin-panel/dashboard">Dashboard</Link></li>
                                <li className="breadcrumb-item"><Link href="/admin-panel/user">User</Link></li>
                                <li className="breadcrumb-item active">Edit</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>

            <section className="content">
                <div className="container-fluid">
                    <form onSubmit={submit} encType="multipart/form-data">
                        <div className="row">
                            <div className="col-md-6">
                                <div className="card card-primary">
                                    <div className="card-header"></div>
                                    <div className="card-body">
                                        <div className="form-group">
                                            <label>Status</label>
                                            <select 
                                                className="form-control" 
                                                name="is_active" 
                                                defaultValue={data.is_active}
                                                onChange={(e)=>{
                                                    setData('is_active', e.target.value)
                                                }}
                                            >
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>
                                        <div className="form-group">
                                            <label>Role</label>
                                            <select 
                                                className="form-control" 
                                                name="role_id" 
                                                defaultValue={data.role_id}
                                                onChange={(e)=>{
                                                    setData('role_id', e.target.value)
                                                    clearErrors('role_id')
                                                }}
                                            >
                                                <option value="">- Select -</option>
                                                {roles.map((role) => (
                                                    <option value={role.id} key={role.id}>{role.name}</option>
                                                ))}
                                            </select>
                                            {errors.role_id && (
                                                <div className="invalid-feedback d-block">{errors.role_id}</div>
                                            )}
                                        </div>
                                        <div className="form-group">
                                            <label>Name</label>
                                            <input 
                                                type="text" 
                                                className="form-control" 
                                                name="name" 
                                                placeholder="Enter name" 
                                                defaultValue={data.name}
                                                onChange={(e)=>{
                                                    setData('name', e.target.value)
                                                    clearErrors('name')
                                                }}
                                            />
                                            {errors.name && (
                                                <div className="invalid-feedback d-block">{errors.name}</div>
                                            )}
                                        </div>
                                        <div className="form-group">
                                            <label>Email</label>
                                            <input 
                                                type="email" 
                                                className="form-control" 
                                                name="email" 
                                                placeholder="Enter email" 
                                                defaultValue={data.email}
                                                onChange={(e)=>{
                                                    setData('email', e.target.value)
                                                    clearErrors('email')
                                                }}
                                            />
                                            {errors.email && (
                                                <div className="invalid-feedback d-block">{errors.email}</div>
                                            )}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div className="col-md-6">
                                <div className="card card-primary">
                                    <div className="card-header"></div>
                                    <div className="card-body">
                                        <div className="form-group">
                                            <label>Password</label>
                                            <input 
                                                type="password" 
                                                className="form-control" 
                                                name="password" 
                                                placeholder="Enter password" 
                                                onChange={(e)=>{
                                                    setData('password', e.target.value)
                                                    clearErrors('password')
                                                }}
                                            />
                                            {errors.password && (
                                                <div className="invalid-feedback d-block">{errors.password}</div>
                                            )}
                                        </div>
                                        <div className="form-group">
                                            <label>Confirm Password</label>
                                            <input 
                                                type="password" 
                                                className="form-control" 
                                                name="password_confirmation" 
                                                placeholder="Confirm password"
                                                onChange={(e)=>{
                                                    setData('password_confirmation', e.target.value)
                                                    clearErrors('password_confirmation')
                                                }}
                                            />
                                            {errors.password_confirmation && (
                                                <div className="invalid-feedback d-block">{errors.password_confirmation}</div>
                                            )}
                                        </div>
                                        <div className="form-group">
                                            <span>Please leave password fields empty if you do not want to update the password.</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div className="col-md-12 a-center mb-3">
                                <Link href="/admin-panel/user" className="btn btn-secondary btn-sm" style={{ marginRight: '5px' }}><i className="fas fa-chevron-left mr-1"></i> Back</Link>
                                <button type="submit" className="btn btn-primary btn-sm" disabled={processing}>
                                    {processing 
                                        ? <div className="loader"></div>
                                        : <>
                                            <i className="fas fa-save mr-1"></i> Submit
                                          </>
                                    }
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
        </AdminLayout>
    )
}