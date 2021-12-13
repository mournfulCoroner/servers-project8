FROM adoptopenjdk:11-jre-hotspot
ARG JAR_FILE=./java/target/*.jar
COPY ${JAR_FILE} application.jar
ENTRYPOINT ["java", "-jar", "-Dspring.datasource.url=jdbc:mysql://db:3306/appDB", "-Dspring.redis.host=redis", "application.jar"]
