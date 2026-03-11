import { useEffect } from 'react'
import { Head, Form, usePage } from '@inertiajs/react'
import Alert from '@/Components/Alert'

export default function Login() {
    useEffect(() => {
        document.body.className = "hold-transition login-page"
        return () => {
            document.body.className = ""
        }
    }, [])

    const { errors } = usePage().props

    return (
        <div className="login-box">
            <Head title="Login" />
            <Alert />
            <div className="card card-outline card-primary">
                <div className="card-header text-center">
                    <a className="h1"><b>Admin</b>LTE</a>
                </div>
                <div className="card-body">
                    <p className="login-box-msg">Sign in to start your session</p>

                    <Form action="/admin-panel/login" method="post">
                        <div className="input-group mb-3">
                            <input type="email" className="form-control" placeholder="Email" name="email" />
                            <div className="input-group-append">
                                <div className="input-group-text">
                                    <span className="fas fa-envelope"></span>
                                </div>
                            </div>
                            {errors.email && (
                                <div className="invalid-feedback d-block">{errors.email}</div>
                            )}
                        </div>
                        <div className="input-group mb-3">
                            <input type="password" className="form-control" placeholder="Password" name="password" />
                            <div className="input-group-append">
                                <div className="input-group-text">
                                    <span className="fas fa-lock"></span>
                                </div>
                            </div>
                            {errors.password && (
                                <div className="invalid-feedback d-block">{errors.password}</div>
                            )}
                        </div>
                        <div className="row">
                            <div className="col-8">
                                <div className="icheck-primary">
                                    <input type="checkbox" id="remember" name="remember" />
                                    <label htmlFor="remember">
                                        Remember Me
                                    </label>
                                </div>
                            </div>
                            <div className="col-4">
                                <button type="submit" className="btn btn-primary btn-block">Sign In</button>
                            </div>
                        </div>
                    </Form>
                </div>
            </div>
        </div>
    )
}