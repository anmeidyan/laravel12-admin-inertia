import AdminLayout from '@/Layouts/AdminApp'
import { useEffect } from 'react'
import { Head, Link, useForm } from '@inertiajs/react'

export default function Create() {
    const { data, setData, post, processing, errors, clearErrors } = useForm({
        is_active: 1,
        title: "",
        description: "",
        image_path: ""
    })

    useEffect(() => {
        window.SetUrl = function (items) {
            const filePath = items[0].url
            setData('image_path',filePath)
        }
    }, [])

    function openFileManager() {
        window.open(
            '/admin-panel/filemanager?type=image',
            'FileManager',
            'width=900,height=600'
        )
    }

    function submit(e){
        e.preventDefault()

        post('/admin-panel/slideshow', {
            preserveScroll: true
        })
    }

    return (
        <AdminLayout>
            <Head title="Create Slideshow" />
            <section className="content-header">
                <div className="container-fluid">
                    <div className="row mb-2">
                        <div className="col-sm-6">
                            <h1>Create Slideshow</h1>
                        </div>
                        <div className="col-sm-6">
                            <ol className="breadcrumb float-sm-right">
                                <li className="breadcrumb-item"><Link href="/admin-panel/dashboard">Dashboard</Link></li>
                                <li className="breadcrumb-item"><Link href="/admin-panel/slideshow">Slideshow</Link></li>
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
                                                    clearErrors('is_active')
                                                }}
                                            >
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>
                                        <div className="form-group">
                                            <label>Title</label>
                                            <input 
                                                type="text" 
                                                className="form-control" 
                                                name="title" 
                                                placeholder="Enter slideshow title" 
                                                defaultValue={data.title}
                                                onChange={(e)=>{
                                                    setData('title', e.target.value)
                                                    clearErrors('title')
                                                }}
                                            />
                                            {errors.title && (
                                                <div className="invalid-feedback d-block">{errors.title}</div>
                                            )}
                                        </div>
                                        <div className="form-group">
                                            <label>Description</label>
                                            <textarea 
                                                className="form-control" 
                                                name="description" 
                                                placeholder="Enter slideshow description" 
                                                defaultValue={data.description}
                                                onChange={(e)=>{
                                                    setData('description', e.target.value)
                                                    clearErrors('description')
                                                }}
                                            />
                                            {errors.description && (
                                                <div className="invalid-feedback d-block">{errors.description}</div>
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
                                            <label className="d-block">Image</label>
                                            <button 
                                                type="button" 
                                                className="btn btn-info"
                                                onClick={openFileManager}
                                                style={{ marginRight: '5px' }}
                                            >
                                                <i className="fas fa-image"></i>
                                            </button>
                                            <input 
                                                type="hidden" 
                                                className="form-control" 
                                                name="image_path" 
                                                defaultValue={data.image_path}
                                                onChange={(e)=>{
                                                    setData('image_path', e.target.value)
                                                    clearErrors('image_path')
                                                }}
                                            />
                                            {data.image_path && (
                                                <img
                                                    src={data.image_path}
                                                    style={{ width: "200px", marginTop: "10px" }}
                                                />
                                            )}
                                            {errors.image_path && (
                                                <div className="invalid-feedback d-block">{errors.image_path}</div>
                                            )}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div className="col-md-12 a-center mb-3">
                                <Link href="/admin-panel/slideshow" className="btn btn-secondary btn-sm" style={{ marginRight: '5px' }}><i className="fas fa-chevron-left mr-1"></i> Back</Link>
                                <button type="submit" className="btn btn-primary btn-sm" disabled={processing}>
                                    {processing 
                                        ? <div class="loader"></div>
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