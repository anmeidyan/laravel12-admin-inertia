import React from 'react'
import AdminLayout from '@/Layouts/AdminApp'
import { Head, Link, useForm } from '@inertiajs/react'

export default function Create({ menus }) {
    const { data, setData, post, processing, errors, clearErrors } = useForm({
            is_active: 1,
            name: "",
            permission_ids: []
    })

    function submit(e){
        e.preventDefault()

        post('/admin-panel/role', {
            preserveScroll: true
        })
    }

    return (
        <AdminLayout>
            <Head title="Create Role" />
            <section className="content-header">
                <div className="container-fluid">
                    <div className="row mb-2">
                        <div className="col-sm-6">
                            <h1>Create Role</h1>
                        </div>
                        <div className="col-sm-6">
                            <ol className="breadcrumb float-sm-right">
                                <li className="breadcrumb-item"><Link href="/admin-panel/dashboard">Dashboard</Link></li>
                                <li className="breadcrumb-item"><Link href="/admin-panel/role">Role</Link></li>
                                <li className="breadcrumb-item active">Create</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>

            <section className="content">
                <div className="container-fluid">
                    <form onSubmit={submit} encType="multipart/form-data">
                        <div className="row">
                            <div className="col-md-4">
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
                                                    clearErrors('is_active')
                                                }}
                                            >
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>
                                        <div className="form-group">
                                            <label>Role Name</label>
                                            <input 
                                                type="text" 
                                                className="form-control" 
                                                name="name" 
                                                placeholder="Enter role name" 
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
                                    </div>
                                </div>
                            </div>
                            <div className="col-md-8">
                                <div className="card card-primary">
                                    <div className="card-header"></div>
                                    <div className="card-body">
                                        <table className="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Menu</th>
                                                    <th>Permission</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {menus && Array.isArray(menus) && menus.map((menu) => (
                                                    <React.Fragment key={menu.id}>
                                                        <tr key={menu.id}>
                                                            <td>{menu.name}</td>
                                                            <td>
                                                                {menu.permissions && menu.permissions.length > 0 ? (
                                                                    menu.permissions.map((permission) => (
                                                                        <div className="icheck-primary d-inline mr-3" key={`permission_${permission.id}`}>
                                                                            <input
                                                                                type="checkbox"
                                                                                name="permission_ids[]"
                                                                                value={permission.id}
                                                                                id={`permission_${permission.id}`}
                                                                                checked={data.permission_ids.includes(permission.id)}
                                                                                onChange={(e) => {
                                                                                    if (e.target.checked) {
                                                                                        setData('permission_ids', [...data.permission_ids, permission.id])
                                                                                    } else {
                                                                                        setData('permission_ids', data.permission_ids.filter((id) => id !== permission.id))
                                                                                    }
                                                                                }}
                                                                            />
                                                                            <label htmlFor={`permission_${permission.id}`}>{permission.name}</label>
                                                                        </div>
                                                                    ))
                                                                ) : (
                                                                    <>There is no permission.</>
                                                                )}
                                                            </td>
                                                        </tr>
                                                        {menu.children && menu.children.length > 0 && (
                                                            menu.children.map((child) => (
                                                                <tr key={child.id}>
                                                                    <td>-- {child.name}</td>
                                                                    <td>
                                                                        {child.permissions && child.permissions.length > 0 ? (
                                                                            child.permissions.map((permission) => (
                                                                                <div className="icheck-primary d-inline mr-3" key={`permission_${permission.id}`}>
                                                                                    <input
                                                                                        type="checkbox"
                                                                                        name="permission_ids[]"
                                                                                        value={permission.id}
                                                                                        id={`permission_${permission.id}`}
                                                                                        checked={data.permission_ids.includes(permission.id)}
                                                                                        onChange={(e) => {
                                                                                            if (e.target.checked) {
                                                                                                setData('permission_ids', [...data.permission_ids, permission.id])
                                                                                            } else {
                                                                                                setData('permission_ids', data.permission_ids.filter((id) => id !== permission.id))
                                                                                            }
                                                                                        }}
                                                                                    />
                                                                                    <label htmlFor={`permission_${permission.id}`}>{permission.name}</label>
                                                                                </div>
                                                                            ))
                                                                        ) : (
                                                                            <>There is no permission.</>
                                                                        )}
                                                                    </td>
                                                                </tr>
                                                            ))
                                                        )}
                                                    </React.Fragment>
                                                ))}
                                            </tbody>
                                        </table>
                                        {errors.permission_ids && (
                                            <div className="invalid-feedback d-block">{errors.permission_ids}</div>
                                        )}
                                    </div>
                                </div>
                            </div>
                            <div className="col-md-12 a-center mb-3">
                                <Link href="/admin-panel/role" className="btn btn-secondary btn-sm" style={{ marginRight: '5px' }}><i className="fas fa-chevron-left mr-1"></i> Back</Link>
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