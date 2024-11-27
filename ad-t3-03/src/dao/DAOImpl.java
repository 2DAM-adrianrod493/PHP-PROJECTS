package dao;

import model.Articulo;
import utils.Conexion;

import java.io.IOException;
import java.sql.*;
import java.util.ArrayList;
import java.util.List;
import java.util.logging.Level;
import java.util.logging.Logger;

public class DAOImpl implements DAO {
    private static final Logger logTag = Logger.getLogger("AD");

    @Override
    public boolean insertar(Articulo articulo) {
        Connection c;
        boolean valueReturn = false;

        // implementar código

        return valueReturn;
    }

    @Override
    public List<Articulo> listarArticulos() {
        Connection c;
        List<Articulo> listaArticulos = new ArrayList<Articulo>();
        String sql = "SELECT * FROM articulo";

        try {
            c = Conexion.getConnection();
            Statement statement = c.createStatement();
            ResultSet resulSet = statement.executeQuery(sql);
            while (resulSet.next()) {
                // Consultar campos
                int id = resulSet.getInt("id");
                String codigo = resulSet.getString("codigo");
                String nombre = resulSet.getString("nombre");
                String descripcion = resulSet.getString("descripcion");
                Double existencia = resulSet.getDouble("existencia");
                Double precio = resulSet.getDouble("precio");
                Integer categoria = resulSet.getInt("idcategoria");

                Articulo articulo = new Articulo(id, codigo, nombre, descripcion, existencia, precio, categoria);
                // Insertar objeto en colección
                listaArticulos.add(articulo);
            }
            c.close();
        } catch (SQLException e) {
            logTag.severe("Error al consultar: ");
            showSQLErrors(e);
        } catch (Exception e) {
            logTag.severe(e.getMessage());
        }
        return listaArticulos;
    }


    // LISTAR ARTÍCULOS POR CATEGORÍA POR CÓDIGO
    @Override
    public List<Articulo> listarArticulosPorCategoria(String categoria) {
        Connection c;
        List<Articulo> listaArticulos = new ArrayList<Articulo>();

        try {
            c = Conexion.getConnection();
            String sql = "SELECT * FROM articulo JOIN categoria ON articulo.idcategoria = categoria.id " +
                    "WHERE categoria.descripcion = ?";
            PreparedStatement statement = c.prepareStatement(sql);
            statement.setString(1, categoria);
            ResultSet rs = statement.executeQuery();

            while (rs.next()) {
                listaArticulos.add(
                        new Articulo(rs.getInt(1), rs.getString(2),
                                rs.getString(3), rs.getString(4),
                                rs.getDouble(5), rs.getDouble(6),
                                rs.getInt(7))
                );
            }
            c.close();
        } catch (SQLException e) {
            logTag.log(Level.SEVERE, "Error de ejecución SQL");
            showSQLErrors(e);
        } catch (IOException e) {
            logTag.log(Level.SEVERE, "Error de E/S");
            System.err.println(e.getLocalizedMessage());
        }

        return listaArticulos;
    }

    /*
    // LISTAR ARTÍCULOS POR CATEGORÍA POR CALLABLE STATEMENT
 @Override
    public List<Articulo> listarArticulosPorCategoria(String categoria) {
        Connection c;
        List<Articulo> listaArticulos = new ArrayList<Articulo>();
        String sql = "{call articulos_categoria(?)}";

        try {
            c = Conexion.getConnection();
            CallableStatement callableStatement = c.prepareCall(sql);
            callableStatement.setString(1, categoria);
            boolean result = callableStatement.execute(); // Ejecutar sentencia de llamada a procedimiento almacenado

            // Obtener resultados a mostrar
            if (result) {
                ResultSet resulSet = callableStatement.getResultSet();

                while (resulSet.next()) {
                    // Consultar campos
                    int id = resulSet.getInt("id");
                    String codigo = resulSet.getString("codigo");
                    String nombre = resulSet.getString("nombre");
                    String descripcion = resulSet.getString("descripcion");
                    Double existencia = resulSet.getDouble("existencia");
                    Double precio = resulSet.getDouble("precio");
                    Integer categoria_articulo = resulSet.getInt("idcategoria");

                    // Crear objeto Articulo
                    Articulo articulo = new Articulo(id, codigo, nombre, descripcion, existencia, precio, categoria_articulo);

                    // Insertar objeto en colección
                    listaArticulos.add(articulo);
                }
            }

            Conexion.close();
        } catch (SQLException e) {
            logTag.severe("Error al consultar: ");
            showSQLErrors(e);
        } catch (Exception e) {
            logTag.severe(e.getMessage());
        }

        return listaArticulos;
    }
*/

    @Override
    public Articulo obtenerPorId(int id) {
        Connection c;
        boolean encontrado = false;

        // implementar código

        Articulo articulo = null;
        return articulo;
    }

    @Override
    public boolean actualizar(Articulo articulo) {
        Connection c;
        boolean valueReturn = false;

        // implementar código

        return valueReturn;
    }

    @Override
    public boolean eliminar(int id) {
        Connection c;
        boolean valueReturn = false;

        // implementar código

        return valueReturn;
    }

    /**
     * Muestra los errores y excepciones producidas en la operación en la base de datos.
     *
     * @param e Excepción
     */
    private static void showSQLErrors(SQLException e) {
        System.err.println("SQLState: " + e.getSQLState());
        System.err.println("Error Code: " + e.getErrorCode());
        System.err.println("Message: " + e.getMessage());
    }
}