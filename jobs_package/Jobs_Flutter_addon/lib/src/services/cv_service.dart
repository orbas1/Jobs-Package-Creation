import '../models/cv.dart';
import 'api_client.dart';

class CvService {
  CvService(this.client);

  final JobsApiClient client;

  Future<List<CvDocument>> fetchCvs() async {
    final payload = await client.getJson('/api/cv');
    return (payload['data'] as List<dynamic>? ?? [])
        .map((e) => CvDocument.fromJson(e as Map<String, dynamic>))
        .toList();
  }

  Future<CvDocument> fetchCv(int id) async {
    final payload = await client.getJson('/api/cv/$id');
    return CvDocument.fromJson(payload['data'] as Map<String, dynamic>);
  }

  Future<void> saveCv(CvDocument cv) async {
    await client.postJson('/api/cv/${cv.id}', body: cv.toJson());
  }

  Future<void> deleteCv(int id) async {
    await client.delete('/api/cv/$id');
  }
}
